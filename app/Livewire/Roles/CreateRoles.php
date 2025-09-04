<?php

namespace App\Livewire\Roles;

use App\Models\Role;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Spatie\Permission\Models\Permission;

use Yoeunes\Toastr\Facades\Toastr;

class CreateRoles extends Component
{
    use AuthorizesRequests;

    public $open = false;
    public $name;
    public array $userRoles = [];

    protected array $groupLabels = [
        'dashboard'     => 'Panel de control',
        'users'         => 'Usuarios',
        'peoples'       => 'Personas',
        'roles'         => 'Roles',
        'rfid-cards'    => 'Tarjetas RFID',
        'access'        => 'Accesos',
        'reports'       => 'Reportes',
    ];


    public function rules()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'userRoles' => 'required|array|min:1',
        ];

        return $rules;
    }

    public function save()
    {
        $this->validate();

        $role = Role::create(['name' => $this->name]);
        // Asignar permisos seleccionados
        $role->syncPermissions($this->userRoles);

        Toastr::success('Se ha creado correctamente.', 'Notificación', [
            'timeOut' => 5000,
            'progressBar' => true,
            'positionClass' => 'toast-top-right',
        ]);


        $this->dispatch('create-roles');

        $this->reset('name', 'userRoles', 'open');
    }

    public function updatingOpen()
    {
        if (!$this->open) {
            $this->reset('name', 'userRoles');
        }
    }

    public function render()
    {
        $permissions = Permission::all()->groupBy(function ($perm) {
            return explode('.', $perm->name)[1]; // agrupa por módulo como users, peoples, etc.
        });

        return view('livewire.roles.create-roles',  [
            'permissions' => $permissions,
            'groupLabels' => $this->groupLabels,
        ]);
    }
}
