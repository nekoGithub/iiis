<?php

namespace Database\Seeders;

use App\Models\Access;
use App\Models\People;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AccessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dias = 180; // últimos 6 meses
        $ubicaciones = ['Biblioteca', 'Laboratorio', 'Aula A1', 'Sala Docente'];

        $personas = People::with('rfidCard')->get()->filter(fn($p) => $p->rfidCard);

        foreach (range(0, $dias - 1) as $i) {
            $fecha = now()->subDays($dias - $i)->toDateString(); // YYYY-MM-DD

            // Simular de 5 a 15 accesos ese día
            $accesosDia = rand(5, 15);

            $personasDelDia = $personas->random($accesosDia);

            $horaBase = now()->setTime(7, 0); // Comienza a las 7:00am

            foreach ($personasDelDia as $persona) {
                $entrada = $horaBase->copy()->addMinutes(rand(0, 10));
                $salida = (clone $entrada)->addHours(rand(1, 4));

                Access::create([
                    'people_id' => $persona->id,
                    'card_id' => $persona->rfidCard->id,
                    'fecha_acceso' => $fecha,
                    'hora_entrada' => $entrada->format('H:i:s'),
                    'hora_salida' => $salida->format('H:i:s'),
                    'ubicacion' => $ubicaciones[array_rand($ubicaciones)],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                $horaBase = $entrada->copy()->addMinutes(rand(5, 10)); // siguiente entrada
            }
        }
    }
}
