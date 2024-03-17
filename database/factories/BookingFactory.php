<?php

namespace Database\Factories;

use App\Models\Booking;
use App\Models\Hotel;
use App\Models\Room;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Booking::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // Define date range constraints
        $startDate = Carbon::now();
        $endDate = $startDate->copy()->addDays(30); // Adjust this value as needed

        // Generate random check-in and check-out dates within the date range
        $checkIn = $this->faker->dateTimeBetween($startDate, $endDate);
        $checkOut = $this->faker->dateTimeBetween($checkIn, $endDate);

        // Ensure check-out date is after check-in date
        while ($checkOut <= $checkIn) {
            $checkOut = $this->faker->dateTimeBetween($checkIn, $endDate);
        }

        return [
            'user_id' => User::factory()->create()->id,
            'room_id' => Room::factory()->create()->id,
            'hotel_id' => Hotel::factory()->create()->id,
            'check_in' => $checkIn,
            'check_out' => $checkOut,
            'total_price' => $this->faker->randomFloat(2, 50, 500),
            'status' => 'NEW',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
