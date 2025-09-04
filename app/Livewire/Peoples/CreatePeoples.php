<?php

namespace App\Livewire\Peoples;

use App\Models\People;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Yoeunes\Toastr\Facades\Toastr;
use Livewire\WithFileUploads;

class CreatePeoples extends Component
{
    use WithFileUploads;
    use AuthorizesRequests;

    public $open = false;
    public $name, $last_name, $email, $phone, $birthdate, $gender, $photo, $registration_date;
    public $type = null;
    public $semester, $status='activo', $enrollment_number, $guardian_name, $guardian_phone;
    public $ci;
    public $address;

    public function rules()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:peoples,email',
            'phone' => 'required|regex:/^[0-9]{8,10}$/',
            'birthdate' => 'required|date',
            'gender' => 'required|in:masculino,femenino,otro',
            'photo' => 'required',
            'ci' => 'required|string|max:20|unique:peoples,ci',
            'type' => 'required|in:administrativo,docente,estudiante',
            'address' => 'nullable|string|max:255',
        ];

        if ($this->type === 'estudiante') {
            $rules = array_merge($rules, [
                'semester' => 'required|string|max:50',
                'status' => 'required|in:activo,retirado,egresado',
                'enrollment_number' => 'required|string|unique:students,enrollment_number',
                'guardian_name' => 'nullable|string|max:255',
                'guardian_phone' => 'nullable|regex:/^[0-9]{8,15}$/',
            ]);
        }

        return $rules;
    }

    public function save()
    {
        $this->validate();

        $photoPath = $this->photo->store('photos', 'public');

        $people = People::create([
            'name' => $this->name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'ci' => $this->ci,
            'type' => $this->type,
            'address' => $this->address,
            'phone' => $this->phone,
            'birthdate' => $this->birthdate,
            'gender' => $this->gender,
            'photo' => $photoPath,
            'registration_date' => now(),
        ]);

        if ($this->type === 'estudiante') {
            $people->student()->create([
                'semester' => $this->semester,
                'status' => $this->status,
                'enrollment_number' => $this->enrollment_number,
                'guardian_name' => $this->guardian_name,
                'guardian_phone' => $this->guardian_phone,
            ]);
        }

        $people->rfidCard()->create([
            'codigo_rfid' => null,
            'fecha_emision' => null,
        ]);

        Toastr::success('Se ha creado correctamente.', 'Notificación', [
            'timeOut' => 5000,
            'progressBar' => true,
            'positionClass' => 'toast-top-right',
        ]);


        $this->dispatch('create-peoples');

        $this->reset('name', 'last_name', 'email', 'ci', 'type', 'address', 'phone', 'birthdate', 'gender', 'photo', 'semester', 'status', 'open');
    }

    public function updatingOpen()
    {
        if (!$this->open) {
            $this->reset('name', 'last_name', 'email', 'ci', 'type', 'address', 'phone', 'birthdate', 'gender', 'photo', 'semester', 'status');
        }
    }

    public function mount()
    {
        $this->authorize('admin.peoples.create');
    }

    public function render()
    {
        return view('livewire.peoples.create-peoples');
    }
}
