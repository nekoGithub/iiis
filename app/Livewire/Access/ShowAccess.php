<?php

namespace App\Livewire\Access;

use App\Models\Access;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class ShowAccess extends Component
{
    use WithPagination;

    #[On('actualizar-datos')]
    public function refresh()
    {
        // Livewire volverá a ejecutar render(), lo que recargará la tabla
        // No necesitas cargar manualmente aquí, si usas paginate() en render
    }

    public function render()
    {
        $access = Access::paginate(10);
        return view('livewire.access.show-access', compact('access'));
    }
}
