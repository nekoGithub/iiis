<?php

namespace App\Livewire\Reports;

use App\Models\People;
use App\Models\Access;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use Barryvdh\DomPDF\Facade\Pdf;

class SearchPeople extends Component
{
    use AuthorizesRequests, WithPagination;

    public $search = '';
    public $personaSeleccionada;
    public $totalAccesos = 0;
    public $periodo = 'dia';
    public $accesosDetallados = [];
    public $estadisticas = [];
    public $mostrarDetalles = false;

    protected $rules = [
        'search' => 'required|min:2',
        'periodo' => 'required|in:dia,semana,mes,año'
    ];

    protected $messages = [
        'search.required' => 'Debe ingresar un término de búsqueda.',
        'search.min' => 'Debe ingresar al menos 2 caracteres.',
        'periodo.required' => 'Debe seleccionar un período.',
        'periodo.in' => 'El período seleccionado no es válido.'
    ];

    /*     public function mount()
    {
        $this->authorize('admin.reports.index');
    } */

    public function updatedSearch()
    {
        $this->resetData();
        if (strlen($this->search) >= 2) {
            $this->buscarPersona();
        }
    }

    public function updatedPeriodo()
    {
        if ($this->personaSeleccionada) {
            $this->buscarPersona();
        }
    }

    private function resetData()
    {
        $this->personaSeleccionada = null;
        $this->totalAccesos = 0;
        $this->accesosDetallados = [];
        $this->estadisticas = [];
        $this->mostrarDetalles = false;
        $this->resetValidation();
    }

    private function obtenerRangoFechas()
    {
        $fechaActual = Carbon::now();

        switch ($this->periodo) {
            case 'dia':
                return [
                    'inicio' => $fechaActual->copy()->startOfDay(),
                    'fin' => $fechaActual->copy()->endOfDay(),
                    'label' => 'Hoy (' . $fechaActual->format('d/m/Y') . ')'
                ];
            case 'semana':
                return [
                    'inicio' => $fechaActual->copy()->startOfWeek(),
                    'fin' => $fechaActual->copy()->endOfWeek(),
                    'label' => 'Esta Semana (' . $fechaActual->copy()->startOfWeek()->format('d/m') . ' - ' . $fechaActual->copy()->endOfWeek()->format('d/m/Y') . ')'
                ];
            case 'mes':
                return [
                    'inicio' => $fechaActual->copy()->startOfMonth(),
                    'fin' => $fechaActual->copy()->endOfMonth(),
                    'label' => 'Este Mes (' . $fechaActual->format('M Y') . ')'
                ];
            case 'año':
                return [
                    'inicio' => $fechaActual->copy()->startOfYear(),
                    'fin' => $fechaActual->copy()->endOfYear(),
                    'label' => 'Este Año (' . $fechaActual->format('Y') . ')'
                ];
            default:
                return [
                    'inicio' => $fechaActual->copy()->startOfDay(),
                    'fin' => $fechaActual->copy()->endOfDay(),
                    'label' => 'Hoy'
                ];
        }
    }

    public function buscarPersona()
    {
        $this->validate(['search' => 'required|min:2']);

        $rango = $this->obtenerRangoFechas();

        // Buscar persona
        $this->personaSeleccionada = Access::with(['card', 'people'])
            ->whereHas('people', function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('last_name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%');
            })
            ->first();

        if (!$this->personaSeleccionada) {
            session()->flash('error', 'No se encontró una persona con ese criterio de búsqueda.');
            return;
        }

        // Obtener accesos detallados en el período
        $this->accesosDetallados = Access::with(['card'])
            ->where('people_id', $this->personaSeleccionada->id)
            ->whereBetween('fecha_acceso', [$rango['inicio'], $rango['fin']])
            ->orderByDesc('fecha_acceso')
            ->orderByDesc('hora_entrada')
            ->get()
            ->map(function ($acceso) {
                return [
                    'id' => $acceso->id,
                    'fecha' => Carbon::parse($acceso->fecha_acceso)->format('d/m/Y'),
                    'fecha_completa' => Carbon::parse($acceso->fecha_acceso)->format('l, d \\d\\e F \\d\\e Y'),
                    'hora_entrada' => $acceso->hora_entrada,
                    'hora_salida' => $acceso->hora_salida,
                    'codigo_rfid' => $acceso->card->codigo_rfid ?? 'N/A',
                    'duracion' => $this->calcularDuracion($acceso->hora_entrada, $acceso->hora_salida),
                    'tipo_acceso' => $this->determinarTipoAcceso($acceso)
                ];
            })
            ->toArray();

        // Calcular estadísticas
        $this->calcularEstadisticas($rango);

        $this->totalAccesos = count($this->accesosDetallados);

        session()->flash('success', 'Búsqueda completada exitosamente.');
    }

    private function calcularDuracion($entrada, $salida)
    {
        if (!$entrada || !$salida) {
            return null;
        }

        try {
            $horaEntrada = Carbon::createFromFormat('H:i:s', $entrada);
            $horaSalida = Carbon::createFromFormat('H:i:s', $salida);

            if ($horaSalida->lt($horaEntrada)) {
                $horaSalida->addDay();
            }

            $diferencia = $horaEntrada->diffInMinutes($horaSalida);

            $horas = floor($diferencia / 60);
            $minutos = $diferencia % 60;

            return $horas > 0 ? "{$horas}h {$minutos}m" : "{$minutos}m";
        } catch (\Exception $e) {
            return null;
        }
    }

    private function determinarTipoAcceso($acceso)
    {
        if ($acceso->hora_entrada && $acceso->hora_salida) {
            return 'completo';
        } elseif ($acceso->hora_entrada) {
            return 'solo_entrada';
        } elseif ($acceso->hora_salida) {
            return 'solo_salida';
        }
        return 'incompleto';
    }

    private function calcularEstadisticas($rango)
    {
        $accesos = collect($this->accesosDetallados);

        $this->estadisticas = [
            'total_accesos' => $accesos->count(),
            'accesos_completos' => $accesos->where('tipo_acceso', 'completo')->count(),
            'solo_entradas' => $accesos->where('tipo_acceso', 'solo_entrada')->count(),
            'solo_salidas' => $accesos->where('tipo_acceso', 'solo_salida')->count(),
            'dias_con_acceso' => $accesos->pluck('fecha')->unique()->count(),
            'promedio_diario' => $accesos->count() > 0 ? round($accesos->count() / max(1, $accesos->pluck('fecha')->unique()->count()), 1) : 0,
            'tiempo_total' => $this->calcularTiempoTotal($accesos),
            'rango_periodo' => $rango['label']
        ];
    }

    private function calcularTiempoTotal($accesos)
    {
        $tiempoTotal = 0;

        foreach ($accesos as $acceso) {
            if ($acceso['hora_entrada'] && $acceso['hora_salida']) {
                try {
                    $entrada = Carbon::createFromFormat('H:i:s', $acceso['hora_entrada']);
                    $salida = Carbon::createFromFormat('H:i:s', $acceso['hora_salida']);

                    if ($salida->lt($entrada)) {
                        $salida->addDay();
                    }

                    $tiempoTotal += $entrada->diffInMinutes($salida);
                } catch (\Exception $e) {
                    continue;
                }
            }
        }

        $horas = floor($tiempoTotal / 60);
        $minutos = $tiempoTotal % 60;

        return $horas > 0 ? "{$horas}h {$minutos}m" : "{$minutos}m";
    }

    public function toggleDetalles()
    {
        $this->mostrarDetalles = !$this->mostrarDetalles;
    }

    public function descargarPdf()
    {
        if (!$this->personaSeleccionada) {
            session()->flash('error', 'Debe buscar una persona antes de descargar el reporte.');
            return;
        }

        if (empty($this->accesosDetallados)) {
            session()->flash('error', 'No hay accesos para descargar en el período seleccionado.');
            return;
        }

        $data = [
            'persona' => $this->personaSeleccionada,
            'accesos' => $this->accesosDetallados,
            'estadisticas' => $this->estadisticas,
            'periodo' => $this->periodo,
            'fechaGeneracion' => Carbon::now()->format('d/m/Y H:i:s'),
        ];

        $pdf = Pdf::loadView('admin.reports.persona-accesos-pdf', $data);
        $pdf->setPaper('A4', 'portrait');

        $nombreArchivo = 'accesos_' .
            str_replace(' ', '_', strtolower($this->personaSeleccionada->name . '_' . $this->personaSeleccionada->last_name)) . '_' .
            $this->periodo . '_' .
            Carbon::now()->format('Y-m-d') . '.pdf';

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->output();
        }, $nombreArchivo, [
            'Content-Type' => 'application/pdf',
        ]);
    }

    public function limpiarBusqueda()
    {
        $this->reset(['search', 'personaSeleccionada', 'totalAccesos', 'accesosDetallados', 'estadisticas', 'mostrarDetalles']);
        $this->resetValidation();
        session()->forget(['success', 'error']);
    }

    public function render()
    {
        return view('livewire.reports.search-people');
    }
}
