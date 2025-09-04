<?php

namespace App\Livewire\Access;

use App\Models\Access;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class ShowAccess extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    public $search = "";
    public $sort = 'id';
    public $direction = 'desc';
    public $cantidad = 10;
    public $readyToLoad = false;

    // Ordenamiento
    public function order($sort)
    {
        if ($this->sort == $sort) {
            $this->direction = $this->direction === 'desc' ? 'asc' : 'desc';
        } else {
            $this->sort = $sort;
            $this->direction = 'asc';
        }
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    /* public function loadRfidCards()
    {
        $this->readyToLoad = true;
    } */


    #[On('actualizar-datos')]
    public function refresh()
    {
        // Livewire volverá a ejecutar render(), lo que recargará la tabla
        // No necesitas cargar manualmente aquí, si usas paginate() en render
    }

    public function mount()
    {
        $this->authorize('admin.access.index');
    }

    public function render()
    {

        $access = Access::with(['people', 'card'])
            ->where(function ($query) {
                $query->where('id', 'like', '%' . $this->search . '%')
                    ->orWhereHas('people', function ($q) {
                        $q->where('name', 'like', '%' . $this->search . '%')
                            ->orWhere('last_name', 'like', '%' . $this->search . '%');
                    })
                    ->orWhereHas('card', function ($q) {
                        $q->where('codigo_rfid', 'like', '%' . $this->search . '%');
                    });
            })
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->cantidad);


        return view('livewire.access.show-access', compact('access'));
    }
}
