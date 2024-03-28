<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Device;

class DeviceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Device::factory(10)->create();
    }
}
