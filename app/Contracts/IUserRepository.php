<?php

namespace App\Contracts;
use App\DTO\UserDTO;
use App\Models\User;
use Illuminate\Http\JsonResponse;


interface IUserRepository
{
    /**@return JsonResponse */
    public function getUsers(): JsonResponse;

    /**
     * @param int $userId
     * @return User|null
     */
    public function getUserById(int $userId): ?User;

    /**
     * @param UserDTO $userDTO
     * @return User
     */
    public function createUser(UserDTO $userDTO): User;

    /**
     * @param string $email
     * @return User|null
     */
    public function getUserByEmail(string $email): ?User;

    /**
     * @param UserDTO $userDTO
     * @param int $id
     * @return User
     */
    public function updateUser(UserDTO $userDTO, int $userId): User;

    /**
     * @param int $userId
     * @return mixed
     */
    public function destroyUser(int $userId);

}
