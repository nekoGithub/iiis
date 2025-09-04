<?php

namespace App\Livewire\Reports;

use App\Models\Access;
use App\Models\People;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use Barryvdh\DomPDF\Facade\Pdf;

class GeneralAccessses extends Component
{
    use AuthorizesRequests, WithPagination;
    
    public $periodo = 'dia';
    public $search = '';
    public $perPage = 10;
        

    public function mount()
    {
        // Cargar datos iniciales
        $this->buscar();
    }

    public function buscar()
    {
        // Reset pagination when searching
        $this->resetPage();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingPeriodo()
    {
        $this->resetPage();
    }

    public function getAccesosProperty()
    {
        $query = Access::with(['people', 'card']);
        $fechaActual = Carbon::now();

        // Filtro por período
        if ($this->periodo === 'dia') {
            $query->whereDate('fecha_acceso', $fechaActual->toDateString());
        } elseif ($this->periodo === 'semana') {
            $query->whereBetween('fecha_acceso', [
                $fechaActual->copy()->startOfWeek(),
                $fechaActual->copy()->endOfWeek(),
            ]);
        } elseif ($this->periodo === 'mes') {
            $query->whereYear('fecha_acceso', $fechaActual->year)
                  ->whereMonth('fecha_acceso', $fechaActual->month);
        }

        // Búsqueda por nombre, apellido o RFID
        if (!empty($this->search)) {
            $query->where(function ($q) {
                $q->whereHas('people', function ($peopleQuery) {
                    $peopleQuery->where('name', 'like', '%' . $this->search . '%')
                               ->orWhere('last_name', 'like', '%' . $this->search . '%');
                })
                ->orWhereHas('card', function ($cardQuery) {
                    $cardQuery->where('codigo_rfid', 'like', '%' . $this->search . '%');
                })
                ->orWhere('ubicacion', 'like', '%' . $this->search . '%');
            });
        }

        return $query->orderBy('fecha_acceso', 'desc')
                    ->orderBy('hora_entrada', 'desc')
                    ->paginate($this->perPage);
    }

    public function exportarPDF()
    {
        // Obtener todos los datos sin paginación para el PDF
        $query = Access::with(['people', 'card']);
        $fechaActual = Carbon::now();

        // Aplicar los mismos filtros
        if ($this->periodo === 'dia') {
            $query->whereDate('fecha_acceso', $fechaActual->toDateString());
        } elseif ($this->periodo === 'semana') {
            $query->whereBetween('fecha_acceso', [
                $fechaActual->copy()->startOfWeek(),
                $fechaActual->copy()->endOfWeek(),
            ]);
        } elseif ($this->periodo === 'mes') {
            $query->whereYear('fecha_acceso', $fechaActual->year)
                  ->whereMonth('fecha_acceso', $fechaActual->month);
        }

        if (!empty($this->search)) {
            $query->where(function ($q) {
                $q->whereHas('people', function ($peopleQuery) {
                    $peopleQuery->where('name', 'like', '%' . $this->search . '%')
                               ->orWhere('last_name', 'like', '%' . $this->search . '%');
                })
                ->orWhereHas('card', function ($cardQuery) {
                    $cardQuery->where('codigo_rfid', 'like', '%' . $this->search . '%');
                })
                ->orWhere('ubicacion', 'like', '%' . $this->search . '%');
            });
        }

        $accesos = $query->orderBy('fecha_acceso', 'desc')
                        ->orderBy('hora_entrada', 'desc')
                        ->get();

        $pdf = PDF::loadView('admin.reports.general-pdf', [
            'accesos' => $accesos,
            'periodo' => $this->periodo,
            'search' => $this->search,
            'fecha_generacion' => Carbon::now()->format('d/m/Y H:i:s')
        ]);

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->output();
        }, 'reporte-accesos-' . $this->periodo . '-' . date('Y-m-d') . '.pdf');
    }

    public function render()
    {
        return view('livewire.reports.general-accessses', [
            'accesos' => $this->accesos
        ]);
    }
}