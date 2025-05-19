<?php

namespace App\Livewire\RfidCards;

use App\Models\RfidCard;
use Livewire\Attributes\On;
use Livewire\Component;

class ShowRfidCards extends Component
{
    public $rfidCards;

    public function mount()
    {
        // Cargar los datos inicialmente
        $this->rfidCards = RfidCard::with('people')->get();
    }

    #[On('refreshComponent')]
    public function refreshData()
    {
        // Refrescar los datos después de la asignación
        $this->rfidCards = RfidCard::with('people')->get();
    }
    public function render()
    {
        return view('livewire.rfid-cards.show-rfid-cards');
    }
}
