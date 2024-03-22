<?php

namespace App\Services;

use App\Contracts\IUserRepository;
use App\DTO\UserDTO;
use App\Models\User;

class UserService
{
    private IUserRepository $repository;

    public function __construct(IUserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAllUsers()
    {
        return $this->repository->getUsers();
    }

    public function getUserById(int $userId)
    {
        return $this->repository->getUserById($userId);
    }

    public function createUser(UserDTO $userDTO): User
    {
        return $this->repository->createUser($userDTO);
    }

    public function updateUser(UserDTO $userDTO, int $userId)
    {
        return $this->repository->updateUser($userDTO, $userId);
    }

    public function destroyUser(int $userId)
    {
        return $this->repository->destroyUser($userId);
    }
}
