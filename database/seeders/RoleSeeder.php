<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use App\Models\Role; // <-- Aquí importamos tu modelo Role personalizado

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Primero, creamos o buscamos los roles para evitar errores si ya existen
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $viewer = Role::firstOrCreate(['name' => 'viewer']);

        // === DASHBOARD ===
        Permission::firstOrCreate([
            'name' => 'admin.dashboard',
            'description' => 'Ver panel de control'
        ])->syncRoles([$admin, $viewer]);

        // === USUARIOS ===
        Permission::firstOrCreate([
            'name' => 'admin.users.index',
            'description' => 'Ver listado de usuarios'
        ])->syncRoles([$admin]);

        Permission::firstOrCreate([
            'name' => 'admin.users.create',
            'description' => 'Crear usuarios'
        ])->syncRoles([$admin]);

        Permission::firstOrCreate([
            'name' => 'admin.users.edit',
            'description' => 'Editar usuarios'
        ])->syncRoles([$admin]);

        Permission::firstOrCreate([
            'name' => 'admin.users.destroy',
            'description' => 'Eliminar usuarios'
        ])->syncRoles([$admin]);

        // === PERSONAS ===
        Permission::firstOrCreate([
            'name' => 'admin.peoples.index',
            'description' => 'Ver listado de personas'
        ])->syncRoles([$admin]);

        Permission::firstOrCreate([
            'name' => 'admin.peoples.create',
            'description' => 'Registrar personas'
        ])->syncRoles([$admin]);

        Permission::firstOrCreate([
            'name' => 'admin.peoples.edit',
            'description' => 'Editar personas'
        ])->syncRoles([$admin]);

        Permission::firstOrCreate([
            'name' => 'admin.peoples.destroy',
            'description' => 'Eliminar personas'
        ])->syncRoles([$admin]);

        // === TARJETAS RFID ===
        Permission::firstOrCreate([
            'name' => 'admin.rfid-cards.index',
            'description' => 'Ver tarjetas RFID'
        ])->syncRoles([$admin]);

        Permission::firstOrCreate([
            'name' => 'admin.rfid-cards.asignar',
            'description' => 'Asignar tarjeta RFID a persona'
        ])->syncRoles([$admin]);

        // === ACCESOS ===
        Permission::firstOrCreate([
            'name' => 'admin.access.index',
            'description' => 'Ver registros de accesos'
        ])->syncRoles([$admin]);

        // === REPORTES ===
        Permission::firstOrCreate([
            'name' => 'admin.reports.index',
            'description' => 'Ver reportes del sistema'
        ])->syncRoles([$admin]);

        // === ROLES ===
        Permission::firstOrCreate([
            'name' => 'admin.roles.index',
            'description' => 'Ver y gestionar roles'
        ])->syncRoles([$admin]);

        // === AUDITORIA ===
        Permission::firstOrCreate([
            'name' => 'admin.auditorias.index',
            'description' => 'Ver auditorias'
        ])->syncRoles([$admin]);

        // === VISUALIZACION RFID ===
        Permission::firstOrCreate([
            'name' => 'admin.screens.index',
            'description' => 'Ver visualizacion rfid'
        ])->syncRoles([$admin,$viewer]);

        // === VISUALIZACION EMOCIONES ===
        Permission::firstOrCreate([
            'name' => 'admin.vistas.index',
            'description' => 'Ver visualizacion emociones'
        ])->syncRoles([$admin]);
    }
}
