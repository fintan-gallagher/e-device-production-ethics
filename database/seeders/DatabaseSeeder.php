<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Record;
use Database\Seeders\RoleSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Record::factory()->count(10)->create();
        // $this->call(RoleSeeder::class);
        // $this->call(UserSeeder::class);
        // \App\Models\User::factory(10)->create();

        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        //I only need to call the LabelSeeder, this calls hasRecords()
        //which seeds the records table with 20 records for each Label
        $this->call(LabelSeeder::class);

        $this->call(ArtistSeeder::class);

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
