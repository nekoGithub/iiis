<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\People>
 */
class PeopleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'email' => $this->faker->unique()->safeEmail,
            'ci' => $this->faker->unique()->numerify('########'),
            'type' => $this->faker->randomElement(['administrativo', 'docente', 'estudiante']),
            'address' => $this->faker->address,
            'phone' => $this->faker->phoneNumber,
            'birthdate' => $this->faker->date('Y-m-d', '-18 years'),
            'gender' => $this->faker->randomElement(['masculino', 'femenino', 'otro']),
            'photo' => null,
            'registration_date' => $this->faker->dateTimeBetween('-6 months', 'now'),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
