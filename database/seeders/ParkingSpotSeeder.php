<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ParkingSpotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 50; $i++) { // Change the number to generate more or fewer records
        DB::table('parking_spots')->insert([
            'name' => $faker->company . ' Parking Lot',
            'location' => $faker->address,
            'capacity' => $faker->numberBetween(20, 100),
            'available_spaces' => $faker->numberBetween(0, 100),
            'price_per_hour' => $faker->randomFloat(2, 1, 20) // price between 1 and 20
        ]);

        }        
    }
}
