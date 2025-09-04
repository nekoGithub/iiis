<?php

namespace App\Livewire\Peoples;

use App\Models\People;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use Yoeunes\Toastr\Facades\Toastr;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class ShowPeoples extends Component
{
    use WithPagination;
    use WithFileUploads;
    use AuthorizesRequests;

    // Propiedades de listado
    public $search = "";
    public $sort = 'id';
    public $direction = 'desc';
    public $cantidad = 10;
    public $readyToLoad = false;

    // Propiedades de edición
    public $openEdit = false;
    public $people;
    public $peopleEdit = [];
    public $studentFields = [];
    public $isStudent = false;

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

    public function loadPeoples()
    {
        $this->readyToLoad = true;
    }

    #[On('create-peoples')]
    public function refresh() {}

    public function rules()
    {
        $rules = [
            'peopleEdit.name' => 'required|string|max:255',
            'peopleEdit.last_name' => 'required|string|max:255',
            'peopleEdit.email' => 'required|email|unique:peoples,email,' . $this->people->id,
            'peopleEdit.phone' => 'required|regex:/^[0-9]{8,10}$/',
            'peopleEdit.birthdate' => 'required|date',
            'peopleEdit.gender' => 'required|in:masculino,femenino,otro',
            'peopleEdit.ci' => 'required|string|max:20',
            'peopleEdit.address' => 'nullable|string|max:255',
            'peopleEdit.type' => 'required|in:estudiante,docente,administrativo',
            'peopleEdit.photo' => 'nullable',
        ];

        if ($this->isStudent) {
            $rules += [
                'studentFields.semester' => 'required|integer|min:1|max:10',
                'studentFields.enrollment_number' => 'required|string|max:30',
                'studentFields.guardian_name' => 'required|string|max:255',
                'studentFields.guardian_phone' => 'required|regex:/^[0-9]{8,10}$/',
                'studentFields.status' => 'required|in:activo,retirado,egresado',
            ];
        }

        return $rules;
    }

    public function validationAttributes()
    {
        return [
            'peopleEdit.name' => 'nombres',
            'peopleEdit.last_name' => 'apellidos',
            'peopleEdit.email' => 'correo electrónico',
            'peopleEdit.phone' => 'teléfono',
            'peopleEdit.birthdate' => 'fecha de nacimiento',
            'peopleEdit.gender' => 'género',
            'peopleEdit.ci' => 'CI',
            'peopleEdit.address' => 'dirección',
            'peopleEdit.type' => 'tipo de persona',
            'peopleEdit.photo' => 'foto',
            'studentFields.semester' => 'semestre',
            'studentFields.enrollment_number' => 'número de matrícula',
            'studentFields.guardian_name' => 'nombre del tutor',
            'studentFields.guardian_phone' => 'teléfono del tutor',
            'studentFields.status' => 'estado del estudiante',
        ];
    }

    public function edit(People $people)
    {
        $this->authorize('admin.peoples.edit');

        $this->people = $people;
        $this->peopleEdit = $people->only([
            'name',
            'last_name',
            'email',
            'phone',
            'birthdate',
            'gender',
            'ci',
            'address',
            'type',
            'photo'
        ]);

        $this->isStudent = strtolower($people->type) === 'estudiante';

        if ($this->isStudent && $people->student) {
            $student = $people->student; // relación uno a uno

            $this->studentFields = [
                'semester' => $student->semester,
                'enrollment_number' => $student->enrollment_number,
                'guardian_name' => $student->guardian_name,
                'guardian_phone' => $student->guardian_phone,
                'status' => $student->status,
            ];
        } else {
            $this->studentFields = [];
        }

        $this->openEdit = true;
    }

    public function cancelEdit()
    {
        $this->reset(['openEdit', 'people', 'peopleEdit', 'studentFields', 'isStudent']);
    }

    public function updatedPeopleEditType($value)
    {
        $this->isStudent = $value === 'estudiante';

        if (!$this->isStudent) {
            $this->studentFields = [];
        }
    }

    public function update()
    {
        $this->authorize('admin.peoples.edit');

        $this->validate();

        if (is_object($this->peopleEdit['photo'])) {
            if ($this->people->photo && Storage::disk('public')->exists($this->people->photo)) {
                Storage::disk('public')->delete($this->people->photo);
            }
            $photoPath = $this->peopleEdit['photo']->store('photos', 'public');
            $this->peopleEdit['photo'] = $photoPath;
        }

        $this->people->update($this->peopleEdit);

        if ($this->isStudent) {
            // Validar que enrollment_number no esté duplicado en otro student
            $exists = \App\Models\Student::where('enrollment_number', $this->studentFields['enrollment_number'])
                ->where('people_id', '!=', $this->people->id)
                ->exists();

            if ($exists) {
                $this->addError('studentFields.enrollment_number', 'El número de matrícula ya está registrado para otro estudiante.');
                return; // detener el update porque hay conflicto
            }

            if ($this->people->student) {
                $this->people->student->update($this->studentFields);
            } else {
                $this->people->student()->create($this->studentFields);
            }
        } else {
            if ($this->people->student) {
                $this->people->student()->delete();
            }
        }



        Toastr::success('Se ha actualizado correctamente.', 'Notificación', [
            'timeOut' => 5000,
            'progressBar' => true,
            'positionClass' => 'toast-top-right',
        ]);

        $this->reset(['openEdit', 'people', 'peopleEdit', 'studentFields', 'isStudent']);
    }

    public function deletePeople($id)
    {
        $this->authorize('admin.peoples.destroy');

        $people = People::find($id);
        if ($people) {
            $people->delete();
            $this->dispatch('peopleDeleted');
        }
    }

    public function mount()
    {
        $this->authorize('admin.peoples.index');
    }

    public function render()
    {
        if ($this->readyToLoad) {
            $peoples = People::where('id', 'like', '%' . $this->search . '%')
                ->orWhere('name', 'like', '%' . $this->search . '%')
                ->orWhere('last_name', 'like', '%' . $this->search . '%')
                ->orWhere('email', 'like', '%' . $this->search . '%')
                ->orWhere('ci', 'like', '%' . $this->search . '%')
                ->orWhere('type', 'like', '%' . $this->search . '%')
                ->orWhere('address', 'like', '%' . $this->search . '%')
                ->orWhere('phone', 'like', '%' . $this->search . '%')
                ->orWhere('birthdate', 'like', '%' . $this->search . '%')  
                ->orWhere('gender', 'like', '%' . $this->search . '%')  
                ->orWhere('registration_date', 'like', '%' . $this->search . '%')  
                ->orderBy($this->sort, $this->direction)
                ->paginate($this->cantidad);
        } else {
            $peoples = [];
        }
        return view('livewire.peoples.show-peoples', compact('peoples'));
    }
}
