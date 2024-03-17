<?php

namespace Database\Factories;

use App\Models\Hotel;
use App\Models\Room;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Room>
 */
class RoomFactory extends Factory
{
    protected $model = Room::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'hotel_id' => Hotel::all()->random()->id,
            'room_number' => $this->faker->unique()->numberBetween(100, 999),
            'type' => $this->faker->randomElement(['Single', 'Double', 'Suite']),
            'capacity' => $this->faker->numberBetween(1, 6),
            'price_per_night' => $this->faker->randomFloat(2, 50, 300),
            'is_available' => $this->faker->boolean,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
    }
}
