<?php

namespace App\DTO;

class BookingDTO
{
    public function __construct(
        private readonly string $userId,
        private readonly string $roomId,
        private readonly string $hotelId,
        private readonly string $checkIn,
        private readonly string $checkOut,
        private readonly float  $totalPrice,
        private readonly string $status = 'NEW'
    ) {
    }

    public function getUserId(): string
    {
        return $this->userId;
    }

    public function getRoomId(): string
    {
        return $this->roomId;
    }

    public function getHotelId(): string
    {
        return $this->hotelId;
    }

    public function getCheckIn(): string
    {
        return $this->checkIn;
    }

    public function getCheckOut(): string
    {
        return $this->checkOut;
    }

    public function getTotalPrice(): float
    {
        return $this->totalPrice;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public static function fromArray(array $data): static
    {
        return new static(
            userId: $data['user_id'],
            roomId: $data['room_id'],
            hotelId: $data['hotel_id'],
            checkIn: $data['check_in'],
            checkOut: $data['check_out'],
            totalPrice: $data['total_price'],
            status: $data['status'] ?? 'NEW'
        );
    }
}
