<?php

namespace App\Livewire\Users;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Attributes\On;
use Livewire\Component;
use Yoeunes\Toastr\Facades\Toastr;
use Livewire\WithPagination;


class ShowUsers extends Component
{ 
    use WithPagination;
    use AuthorizesRequests;

    /* Propiedades Listar */
    public $search = "";
    public $sort = 'id';
    public $direction = 'desc';
    public $cantidad = 10;
    public $readyToLoad = false;
    /* Propiedades de Editar */
    public $user;
    public $userEdit = [];
    public $openEdit = false;
    public $roles = [];
    public $userRoles =[];

    /* Inicio de seccion de listar Users */
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

    public function loadUsers(){
        $this->readyToLoad = true;
    }
    /* Fin de seccion de listar Users */

    #[On('create-users')]
    public function refresh()
    {
        // Aqui no va nada...
    }

    /* Inicio de seccion de editar user */
    public function rules()
    {
        return [
            'userEdit.name' => 'required|string|max:255',
            'userEdit.email' => 'required|email|unique:users,email,' . $this->user->id,
        ];
    }

    public function validationAttributes()
    {
        return [
            'userEdit.name' => 'nombre',
            'userEdit.email' => 'correo electronico',
        ];
    }

    public function edit(User $user)
    {
        $this->authorize('admin.users.edit');

        $this->roles = Role::all();

        $this->userRoles = $user->roles->pluck('name')->toArray();

        $this->user = $user;
        $this->userEdit = $user->only('name', 'email');
        $this->openEdit = true;
    }

    public function cancelEdit()
    {
        $this->reset(['openEdit', 'user', 'userEdit']);
    }

    public function update()
    {
        $this->authorize('admin.users.edit');

        $this->validate();

        $this->user->update($this->userEdit);
        
        $this->user->syncRoles($this->userRoles);

        Toastr::success('Se ha actualizado correctamente.', 'Notificación', [
            'timeOut' => 5000,
            'progressBar' => true,
            'positionClass' => 'toast-top-right',
        ]);

        $this->reset('openEdit');
    }
    /* Fin de seccion de editar user */

    public function deleteUser($id){

        $this->authorize('admin.users.destroy');

        $user = User::find($id);
        if ($user) {
            $user->delete();
            $this->dispatch('userDeleted');
        }
    }

    public function mount(){
        $this->authorize('admin.users.index');
    }

    public function render()
    {
        if ($this->readyToLoad) {
            $users = User::with('roles')
                ->where('id', 'like', '%' . $this->search . '%')
                ->orWhere('name', 'like', '%' . $this->search . '%')
                ->orWhere('email', 'like', '%' . $this->search . '%')
                ->orWhere('created_at', 'like', '%' . $this->search . '%')
                ->orderBy($this->sort, $this->direction)
                ->paginate($this->cantidad);            
        }else {
            $users = [];
        }
        return view('livewire.users.show-users', compact('users'));
    }
}
