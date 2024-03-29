<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Device>
 */
class PartFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'heading' => $this->faker->sentence,
            'oem' => $this->faker->randomElement(['yes', 'no']),
            'part_url' => $this->faker->url,
            'admin_rec' => $this->faker->randomElement(['yes', 'no']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
