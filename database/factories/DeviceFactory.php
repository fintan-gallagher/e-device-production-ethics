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
            'model' => $this->faker->word,
            'repairability' => $this->faker->numberBetween(0, 100),
            'parts_availability' => $this->faker->randomElement(['Yes', 'No']),
            'recycled' => $this->faker->numberBetween(0, 100),
            'release_year' => $this->faker->date,
            'price' => $this->faker->randomFloat(2, 0, 1500),
            'device_cover' => $this->faker->imageUrl,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
