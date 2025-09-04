<?php

namespace App\Livewire\RfidCards;

use App\Models\RfidCard;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class ShowRfidCards extends Component
{
    use AuthorizesRequests;
    use WithPagination;

    public $search = "";
    public $sort = 'id';
    public $direction = 'desc';
    public $cantidad = 10;
    public $readyToLoad = false;

    /* public $rfidCards; */

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

    public function loadRfidCards()
    {
        $this->readyToLoad = true;
    }

    public function mount()
    {
        $this->authorize('admin.rfid-cards.index');
         $this->readyToLoad = false;
    }

    #[On('refreshComponent')]
    public function refrescarDatos()
    {
        /* $this->rfidCards = RfidCard::with('people')->orderBy('id', 'desc')->get(); */
        $this->readyToLoad = false;
        $this->readyToLoad = true;
    }


    public function render()
    {
        if ($this->readyToLoad) {
            $rfidCards = RfidCard::with('people')
                ->where(function ($query) {
                    $query->where('id', 'like', '%' . $this->search . '%')
                        ->orWhere('codigo_rfid', 'like', '%' . $this->search . '%')
                        ->orWhereHas('people', function ($q) {
                            $q->where('name', 'like', '%' . $this->search . '%')
                                ->orWhere('last_name', 'like', '%' . $this->search . '%');
                        });
                })
                ->orderBy($this->sort, $this->direction)
                ->paginate($this->cantidad);
        } else {
            $rfidCards = collect();
        }
        return view('livewire.rfid-cards.show-rfid-cards', compact('rfidCards'));
    }
}
