<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Sustainable;

class SustainableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Sustainable::factory(5)->create();
    }
}
