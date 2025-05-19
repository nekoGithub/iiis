<?php

namespace App\Livewire\Peoples;

use App\Models\People;
use Livewire\Component;
use Yoeunes\Toastr\Facades\Toastr;
use Livewire\WithFileUploads;

class CreatePeoples extends Component
{
    use WithFileUploads;

    public $open = false;
    public $name, $last_name, $email, $phone, $birthdate, $gender, $photo, $registration_date;

    public function rules(){
        return [
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:peoples,email',
            'phone' => 'required|regex:/^[0-9]{8,10}$/',
            'birthdate' => 'required|date',
            'gender' => 'required|in:masculino,femenino,otro',
            'photo' => 'required',
        ];
    }

    public function save()
    {
        $this->validate();

        $photoPath = $this->photo->store('photos','public');

        People::create([
            'name' => $this->name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'birthdate' => $this->birthdate,
            'gender' => $this->gender,
            'photo' => $photoPath,
        ]);

        Toastr::success('Se ha creado correctamente.', 'Notificación', [
            'timeOut' => 5000,
            'progressBar' => true,
            'positionClass' => 'toast-top-right',
        ]);


        $this->dispatch('create-peoples');

        $this->reset('name', 'last_name', 'email', 'phone', 'birthdate', 'gender', 'photo', 'open');
    }

    public function updatingOpen() {
        if (!$this->open) {
            $this->reset('name', 'last_name', 'email', 'phone', 'birthdate', 'gender', 'photo');
        }
    }

    public function render()
    {
        return view('livewire.peoples.create-peoples');
    }
}
