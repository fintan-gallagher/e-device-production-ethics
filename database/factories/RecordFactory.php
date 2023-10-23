<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Record>
 */
class RecordFactory extends Factory
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
            'artist' => fake()->sentence,
            'genre' => fake()->word,
            'isbn' => fake()->isbn13,
            'year' => fake()->word,
            'description' => fake()->paragraph,
            'record_cover' => fake()->imageUrl,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
