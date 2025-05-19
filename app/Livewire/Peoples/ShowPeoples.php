<?php

namespace App\Livewire\Peoples;

use App\Models\People;
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
    /* Propiedades Listar */
    public $search = "";
    public $sort = 'id';
    public $direction = 'desc';
    public $cantidad = 10;
    public $readyToLoad = false;

    /* Propiedades de Editar */
    public $people;
    public $peopleEdit = [];
    public $openEdit = false;

    /* Inicio de seccion de listar Peoples */
    public function order($sort)
    {
        if ($this->sort == $sort) {
            if ($this->direction == 'desc') {
                $this->direction = 'asc';
            } else {
                $this->direction = 'desc';
            }
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
    /* Fin de seccion de listar Users */

    #[On('create-peoples')]
    public function refresh()
    {
        // Aqui no va nada...
    }

    /* Inicio de seccion de editar peoples */
    public function rules()
    {
        return [
            'peopleEdit.name' => 'required|string|max:255',
            'peopleEdit.last_name' => 'required|string|max:255',
            'peopleEdit.email' => 'required|email|unique:peoples,email,' . $this->people->id,
            'peopleEdit.phone' => 'required|regex:/^[0-9]{8,10}$/',
            'peopleEdit.birthdate' => 'required|date',
            'peopleEdit.gender' => 'required|in:masculino,femenino,otro',
            'peopleEdit.photo' => 'nullable', // puedes permitir que no se vuelva a subir si ya tiene una foto
        ];
    }

    public function validationAttributes()
    {
        return [
            'peopleEdit.name' => 'nombres',
            'peopleEdit.last_name' => 'apellidos',
            'peopleEdit.email' => 'correo electronico',
            'peopleEdit.phone' => 'telefono',
            'peopleEdit.birthdate' => 'fecha de nacimiento',
            'peopleEdit.gender' => 'genero',
            'peopleEdit.photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ];
    }

    public function edit(People $people)
    {
        $this->people = $people;
        $this->peopleEdit = $people->only('name', 'last_name', 'email', 'phone', 'birthdate', 'gender', 'photo');
        $this->openEdit = true;
    }

    public function cancelEdit()
    {
        $this->reset(['openEdit', 'people', 'peopleEdit']);
    }

    public function update()
    {
        $this->validate();

        // Si la foto fue actualizada (es un archivo)
        if (is_object($this->peopleEdit['photo'])) {
            // Opcional: eliminar la anterior si deseas
            if ($this->people->photo && Storage::disk('public')->exists($this->people->photo)) {
                Storage::disk('public')->delete($this->people->photo);
            }

            // Guardar la nueva foto en "photos"
            $photoPath = $this->peopleEdit['photo']->store('photos', 'public');
            $this->peopleEdit['photo'] = $photoPath;
        }

        $this->people->update($this->peopleEdit);

        Toastr::success('Se ha actualizado correctamente.', 'Notificación', [
            'timeOut' => 5000,
            'progressBar' => true,
            'positionClass' => 'toast-top-right',
        ]);

        $this->reset('openEdit');
    }
    /* Fin de seccion de editar peoples */

    public function deletePeople($id){
        $people = People::find($id);
        if ($people) {
            $people->delete();
            $this->dispatch('peopleDeleted');
        }
    }

    public function render()
    {
        if ($this->readyToLoad) {
            $peoples = People::where('name', 'like', '%' . $this->search . '%')
                ->orWhere('last_name', 'like', '%' . $this->search . '%')
                ->orderBy($this->sort, $this->direction)
                ->paginate($this->cantidad);
        } else {
            $peoples = [];
        }
        return view('livewire.peoples.show-peoples', compact('peoples'));
    }
}
