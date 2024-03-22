<?php

namespace App\DTO;

class UserDTO
{
    public function __construct(
        private readonly string $name,
        private readonly string $email,
        private readonly string $phone,
        private readonly string $password
    )
    {

    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public static function fromArray(array $data)
    {
        return new static(
            name: $data['name'],
            email: $data['email'],
            phone: $data['phone'],
            password: $data['password'] ,

        );

    }

}
