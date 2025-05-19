<?php

namespace App\Livewire\Users;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Yoeunes\Toastr\Facades\Toastr;

class CreateUsers extends Component
{
    public $open = false;
    public $name, $email, $password, $password_confirmation;

    public function rules(){
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed'
        ];
    }

/*     public function updated($propertyName){
        $this->validateOnly($propertyName);
    }
 */
    public function save()
    {
        $this->validate();

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        Toastr::success('Se ha creado correctamente.', 'Notificación', [
            'timeOut' => 5000,
            'progressBar' => true,
            'positionClass' => 'toast-top-right',
        ]);


        $this->dispatch('create-users');

        $this->reset('name', 'email', 'password', 'password_confirmation', 'open');
    }

    public function updatingOpen() {
        if (!$this->open) {
            $this->reset('name','email','password','password_confirmation');
        }
    }


    public function render()
    {
        return view('livewire.users.create-users');
    }
}
