<?php

namespace App\DTO;

class HotelDTO
{
    public function __construct(
        private readonly string $name,
        private readonly string $description,
        private readonly string $address,
        private readonly string $phone,
        private readonly string $email,
        private readonly int $cityId,
        private readonly float $rating,
        private readonly int $managerId
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getCityId(): int
    {
        return $this->cityId;
    }

    public function getRating(): float
    {
        return $this->rating;
    }

    public function getManagerId(): int
    {
        return $this->managerId;
    }

    public static function fromArray(array $data): static
    {
        return new static(
            name: $data['name'],
            description: $data['description'],
            address: $data['address'],
            phone: $data['phone'],
            email: $data['email'],
            cityId: $data['city_id'],
            rating: $data['rating'] ?? 0,
            managerId: $data['manager_id']
        );
    }
}
