<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Access;
use App\Models\People;
use App\Models\RfidCard;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Truncar tablas relacionadas sin error FK
        Access::truncate();
        RfidCard::truncate();
        People::truncate();
        \App\Models\Auditoria::truncate();
        \App\Models\User::truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $this->call([
            PeopleSeeder::class,
            AccessSeeder::class,
            UserSeeder::class,
            RoleSeeder::class,
            ReconocimientoSeeder::class,
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Brayan Sonco Machaca',
            'email' => 'brayan@gmail.com',
            'password' => bcrypt('password'),
        ])->assignRole('admin');
        \App\Models\User::factory()->create([
            'name' => 'Viewer User',
            'email' => 'viewer@viewer.com',
            'password' => bcrypt('password'),
        ])->assignRole('viewer');
    }
}
