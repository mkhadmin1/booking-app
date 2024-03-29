<?php

namespace App\Contracts;
use App\DTO\UserDTO;
use App\Http\Resources\BookingsResource;
use App\Http\Resources\FeedbackResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;


interface IUserRepository
{
    /**@return JsonResponse */
    public function getUsers(): JsonResponse;

    /**
     * @param int $userId
     */
    public function getUserById(int $userId): UserResource;

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
     * @param int $userId
     * @return User
     */
    public function updateUser(UserDTO $userDTO, int $userId): User;

    /**
     * @param int $userId
     * @return mixed
     */
    public function destroyUser(int $userId): void;

    public function getUserFeedbacks(int $userId);
    public function getUserBookings(int $userId);


}
