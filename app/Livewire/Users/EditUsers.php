<?php

namespace App\Livewire\Users;

use App\Models\User;
use Livewire\Component;
use Yoeunes\Toastr\Facades\Toastr;

class EditUsers extends Component
{
    public $open = false;
    public $user;
    public $userEdit = [];

    public function mount(User $user){
        $this->user = $user;
        $this->userEdit = $user->only('name','email');
    }

    public function rules(){
        return [
            'userEdit.name' => 'required|string|max:255',
            'userEdit.email' => 'required|email|unique:users,email,' . $this->user->id,
        ];
    }

    public function validationAttributes(){
        return [
            'userEdit.name' => 'nombre',
            'userEdit.email' => 'correo electronico',
        ];
    }

    public function update(){
        $this->validate();

        $this->user->update($this->userEdit);

        Toastr::success('Se ha actualizado correctamente.', 'Notificación', [
            'timeOut' => 5000,
            'progressBar' => true,
            'positionClass' => 'toast-top-right',
        ]);

        $this->dispatch('edit-users');
        
        $this->reset('open');
    }

    
    public function render()
    {
        return view('livewire.users.edit-users');
    }
}
