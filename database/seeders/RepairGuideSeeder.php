<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\RepairGuide;

class RepairGuideSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        RepairGuide::factory(15)->create();
    }
}
