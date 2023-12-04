<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Record; 
use App\Models\Artist;

class ArtistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        Artist::factory()
        ->times(3)
        ->create();

        foreach(Record::all() as $record) {
            $artists = Artist::inRandomOrder()->take(rand(1, 3))->pluck('id');
            $record->artists()->attach($artists);
        }

    }
}
