<?php

namespace Database\Seeders;

use App\Models\Reconocimiento;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReconocimientoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $startDate = Carbon::now()->subMonths(6)->startOfDay();
        $endDate = Carbon::now()->startOfDay();

        while ($startDate->lessThanOrEqualTo($endDate)) {
            // Genera 3 registros por día
            for ($i = 0; $i < 3; $i++) {
                Reconocimiento::factory()->create([
                    'fecha_hora' => $startDate->copy()->addHours(rand(0, 23))->addMinutes(rand(0, 59)),
                ]);
            }

            $startDate->addDay();
        }
    }
}
