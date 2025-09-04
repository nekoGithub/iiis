<?php

namespace App\Livewire\Reports;

use App\Models\Access;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use Barryvdh\DomPDF\Facade\Pdf;

class ShowReports extends Component
{
    use AuthorizesRequests, WithPagination;
    
    public $fechaInicio;
    public $fechaFin;
    public $perPage = 10;
    
    protected $rules = [
        'fechaInicio' => 'required|date',
        'fechaFin' => 'required|date|after_or_equal:fechaInicio',
    ];
    
    protected $messages = [
        'fechaInicio.required' => 'La fecha de inicio es requerida.',
        'fechaInicio.date' => 'La fecha de inicio debe ser una fecha válida.',
        'fechaFin.required' => 'La fecha fin es requerida.',
        'fechaFin.date' => 'La fecha fin debe ser una fecha válida.',
        'fechaFin.after_or_equal' => 'La fecha fin debe ser igual o posterior a la fecha de inicio.',
    ];

    public function mount()
    {
        $this->authorize('admin.reports.index');
    }

    public function updatedFechaInicio()
    {
        $this->validateOnly('fechaInicio');
        
        if ($this->fechaFin && $this->fechaInicio > $this->fechaFin) {
            $this->fechaFin = $this->fechaInicio;
        }
        
        $this->resetPage();
    }

    public function updatedFechaFin()
    {
        $this->validateOnly('fechaFin');
        $this->resetPage();
    }

    public function updatedPerPage()
    {
        $this->resetPage();
    }

    private function getFilteredQuery()
    {
        return Access::with(['people', 'card'])
            ->whereBetween('fecha_acceso', [
                Carbon::parse($this->fechaInicio)->startOfDay(),
                Carbon::parse($this->fechaFin)->endOfDay()
            ])
            ->orderByDesc('id');
    }

    public function descargarPdf()
    {
        $this->validate();
        
        $registros = $this->getFilteredQuery()->get();
        
        if ($registros->isEmpty()) {
            session()->flash('error', 'No hay registros para descargar en el rango seleccionado.');
            return;
        }
        
        $data = [
            'registros' => $registros,
            'fechaInicio' => Carbon::parse($this->fechaInicio)->format('d/m/Y'),
            'fechaFin' => Carbon::parse($this->fechaFin)->format('d/m/Y'),
            'fechaGeneracion' => Carbon::now()->format('d/m/Y H:i:s'),
        ];
        
        $pdf = Pdf::loadView('admin.reports.accesos-pdf', $data);
        $pdf->setPaper('A4', 'landscape');
        
        $nombreArchivo = 'reporte_accesos_' . 
            Carbon::parse($this->fechaInicio)->format('Y-m-d') . '_' .
            Carbon::parse($this->fechaFin)->format('Y-m-d') . '.pdf';
        
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->output();
        }, $nombreArchivo, [
            'Content-Type' => 'application/pdf',
        ]);
    }

    public function limpiarFiltros()
    {
        $this->reset(['fechaInicio', 'fechaFin']);
        $this->resetPage();
        $this->resetValidation();
    }

    public function render()
    {
        $registros = collect();
        $hayFiltros = $this->fechaInicio && $this->fechaFin;
        
        if ($hayFiltros && !$this->getErrorBag()->any()) {
            $registros = $this->getFilteredQuery()
                ->paginate($this->perPage);
        }
        
        return view('livewire.reports.show-reports', [
            'registros' => $registros,
            'hayFiltros' => $hayFiltros
        ]);
    }
}