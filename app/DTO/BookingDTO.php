<?php

namespace App\DTO;

class BookingDTO
{
    public function __construct(
        private string $userId,
        private string $roomId,
        private string $checkIn,
        private string $checkOut,
        private string $status = 'NEW'
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

    public function getCheckIn(): string
    {
        return $this->checkIn;
    }

    public function getCheckOut(): string
    {
        return $this->checkOut;
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
            checkIn: $data['check_in'],
            checkOut: $data['check_out'],
            status: $data['status'] ?? 'NEW'
        );
    }
}
