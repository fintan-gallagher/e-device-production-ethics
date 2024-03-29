<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Part;

class PartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Part::factory(15)->create();
    }
}
