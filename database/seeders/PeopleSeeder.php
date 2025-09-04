<?php

namespace Database\Seeders;

use App\Models\People;
use App\Models\RfidCard;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PeopleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         People::factory()->count(50)->create()->each(function ($person) {
            RfidCard::create([
                'people_id' => $person->id,
                'codigo_rfid' => strtoupper(Str::random(10)),
                'fecha_emision' => now()->subMonths(rand(1, 6)),
                'estado' => 'Activa',
            ]);
        });
    }
}
