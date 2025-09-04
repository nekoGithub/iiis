<?php

namespace App\Livewire\Roles;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Permission;
use App\Models\Role;
use Yoeunes\Toastr\Facades\Toastr;

class ShowRoles extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    // Propiedades de listado
    public $search = "";
    public $sort = 'id';
    public $direction = 'desc';
    public $cantidad = 10;
    public $readyToLoad = false;

    // Propiedades de edición
    public $openEdit = false;
    public $role;
    public $name = '';
    public array $rolePermissions = [];

    protected array $groupLabels = [
        'dashboard'     => 'Panel de control',
        'users'         => 'Usuarios',
        'peoples'       => 'Personas',
        'roles'         => 'Roles',
        'rfid-cards'    => 'Tarjetas RFID',
        'access'        => 'Accesos',
        'reports'       => 'Reportes',
    ];

    

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

    public function loadRoles()
    {
        $this->readyToLoad = true;
    }

    #[On('create-roles')]
    public function refresh()
    {
        // Aqui no va nada...
    }

    // editar rol
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'rolePermissions' => 'required|array|min:1',
        ];
    }
    public function edit(Role $role)
    {
        /* $this->authorize('admin.roles.edit'); */

        $this->role = $role;
        $this->name = $role->name;
        $this->rolePermissions = $role->permissions->pluck('name')->toArray();
        $this->openEdit = true;
    }

    public function update()
    {
       /*  $this->authorize('admin.roles.edit'); */

        $this->validate();

        $this->role->update(['name' => $this->name]);
        $this->role->syncPermissions($this->rolePermissions);

        Toastr::success('Rol actualizado correctamente.', 'Notificación', [
            'timeOut' => 5000,
            'progressBar' => true,
            'positionClass' => 'toast-top-right',
        ]);

        $this->reset(['openEdit', 'name', 'rolePermissions']);
        $this->dispatch('role-updated');
    }

    public function cancelEdit()
    {
        $this->reset(['openEdit', 'name', 'rolePermissions']);
    }

    public function deleteRole($id)
    {

        $rol = Role::find($id);
        if ($rol) {
            $rol->delete();
            $this->dispatch('roleDeleted');
        }
    }

    public function render()
    {
        if ($this->readyToLoad) {
            $roles = Role::where('id', 'like', '%' . $this->search . '%')
                ->orWhere('name', 'like', '%' . $this->search . '%')
                ->orWhere('created_at', 'like', '%' . $this->search . '%')
                ->orderBy($this->sort, $this->direction)
                ->paginate($this->cantidad);
        } else {
            $roles = [];
        }

        $permissions = Permission::all()->groupBy(function ($perm) {
            return explode('.', $perm->name)[1] ?? 'otros';
        });
        return view('livewire.roles.show-roles', compact('roles','permissions'));
    }
}
