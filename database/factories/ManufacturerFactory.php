<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Manufacturer>
 */
class ManufacturerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'address' => $this->faker->address,
            'lng' => $this->faker->longitude,
            'lat' => $this->faker->latitude,
            'email' => $this->faker->email,
            'ethics_score' => $this->faker->numberBetween(0, 100),
            'bio' => $this->faker->paragraph,
            'manufacturer_img' => $this->faker->imageUrl,
        ];
    }
}
