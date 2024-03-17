<?php

namespace Database\Factories;

use App\Models\Booking;
use App\Models\Hotel;
use App\Models\Room;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    protected $model = Booking::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $checkIn = $this->faker->dateTimeBetween('-1 month', '+1 month');
        return [
            'user_id' => User::all()->random()->id,
            'room_id' => Room::all()->random()->id,
            'hotel_id' => Hotel::all()->random()->id,
            'check_in' => $checkIn,
            'check_out' => $this->faker->dateTimeBetween($checkIn, strtotime('+5 days')),
            'total_price' => $this->faker->numberBetween($min = 1500000, $max = 6000000),
            'status' => 'NEW',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
    }
}
