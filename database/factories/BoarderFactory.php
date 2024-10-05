<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Boarder>
 */
class BoarderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'address' => fake()->address(),
            'contact_number' => fake()->phoneNumber(),
            'status' => fake()->numberBetween(0, 1),
            'created_at' => fake()->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
