<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reconocimiento>
 */
class ReconocimientoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'fecha_hora' => null, // lo define el seeder
            'emocion' => $this->faker->randomElement(['enojado', 'disgusto', 'miedo', 'feliz', 'neutral', 'triste', 'sorpresa']),
            'probabilidad' => $this->faker->randomFloat(2, 0.50, 1.00),
            'nombre_archivo' => $this->faker->lexify('imagen_????.jpg'),
            'imagen_path' => $this->faker->imageUrl(640, 480, 'people'),
        ];
    }
}
