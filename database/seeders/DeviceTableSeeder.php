<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Device;
use App\Models\RepairGuide;
use App\Models\Part;

class DeviceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Device::factory(10)->has(RepairGuide::factory()->count(5))->has(Part::factory()->count(5))->create();
    }
}
