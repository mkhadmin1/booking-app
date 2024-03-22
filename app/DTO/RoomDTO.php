<?php

namespace App\DTO;

class RoomDTO
{


    public function __construct(
        private int    $hotel_id,
        private int    $room_number,
        private string $type,
        private int    $capacity,
        private int    $price_per_night,
        private bool   $is_available)
    {
    }

    public function getHotelId(): int
    {
        return $this->hotel_id;
    }

    public function getRoomNumber(): int
    {
        return $this->room_number;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getCapacity(): int
    {
        return $this->capacity;
    }

    public function getPricePerNight(): int
    {
        return $this->price_per_night;
    }

    public function isIsAvailable(): bool
    {
        return $this->is_available;
    }

    public function toArray(): array
    {
        return [
            'hotel_id' => $this->hotel_id,
            'room_number' => $this->room_number,
            'type' => $this->type,
            'capacity' => $this->capacity,
            'price_per_night' => $this->price_per_night,
            'is_available' => $this->is_available,
        ];
    }

    public static function fromArray(array $data): static
    {
        return new static(
            hotel_id: $data['hotel_id'],
            room_number: $data['room_number'],
            type: $data['type'],
            capacity: $data['capacity'],
            price_per_night: $data['price_per_night'],
            is_available: $data['is_available'] ?? true
        );
    }
}
