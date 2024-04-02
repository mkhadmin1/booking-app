<?php

namespace App\DTO;

class FeedbackDTO
{

    public function __construct(
        private int $user_id,
        private int $hotel_id,
        private string $description,
        private int $rating)

    {
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function getHotelId(): int
    {
        return $this->hotel_id;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getRating(): int
    {
        return $this->rating;
    }

    public function toArray()
    {
        return [
            'user_id' => $this->user_id,
            'hotel_id' => $this->hotel_id,
            'description' => $this->description,
            'rating' => $this->rating,
        ];
    }

    public static function fromArray(array $data): static
    {
        return new static(
            user_id: $data['user_id'],
            hotel_id: $data['hotel_id'],
            description: $data['description'],
            rating: $data['rating']
        );
    }
}
