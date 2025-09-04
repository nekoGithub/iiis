<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $totalDias = 7;
        $totalUsuarios = 300;
        $usuariosRestantes = $totalUsuarios;
        $usuariosPorDia = [];

        // Distribuir aleatoriamente el total de usuarios entre los días
        for ($i = 0; $i < $totalDias; $i++) {
            if ($i == $totalDias - 1) {
                // El último día se lleva lo que queda
                $usuariosPorDia[] = $usuariosRestantes;
            } else {
                // Generar una cantidad aleatoria respetando el restante
                $maxUsuarios = min(60, $usuariosRestantes - ($totalDias - $i - 1));
                $minUsuarios = max(2, $usuariosRestantes - ($totalDias - $i - 1) * 60);
                $cantidad = rand($minUsuarios, $maxUsuarios);
                $usuariosPorDia[] = $cantidad;
                $usuariosRestantes -= $cantidad;
            }
        }

        // Ahora generamos los usuarios por día
        for ($i = 0; $i < $totalDias; $i++) {
            $fecha = now()->subDays(6 - $i)->startOfDay();
            $cantidadHoy = $usuariosPorDia[$i];

            for ($j = 0; $j < $cantidadHoy; $j++) {
                $horaAleatoria = $fecha->copy()->addHours(rand(0, 23))->addMinutes(rand(0, 59));

                User::factory()->create([
                    'created_at' => $horaAleatoria,
                    'updated_at' => $horaAleatoria,
                ]);
            }
        }
    }
}
