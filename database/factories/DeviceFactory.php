<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Device>
 */
class DeviceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence,
            'artist' => fake()->word,
            'genre' => fake()->word,
            'isbn' => fake()->isbn13,
            'release_year' => fake()->date,
            'description' => fake()->paragraph,
            'device_cover' => fake()->imageUrl,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

