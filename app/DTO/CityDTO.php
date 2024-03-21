<?php

namespace App\DTO;

class CityDTO
{
    public function __construct(private string $name)
    {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function toArray()
    {
        return [
            'name' => $this->name,
        ];
    }

    public static function fromArray(array $data): static
    {
        return new static(
            name: $data['name']
        );
    }
}
