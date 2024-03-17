<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\City;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            UserSeeder::class,
            CitySeeder::class,
            HotelSeeder::class,
            RoomSeeder::class,
            BookingSeeder::class,
            FeedbackSeeder::class
        ]);
    }
}
