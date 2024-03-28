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
     /**
     * @param int $userId
     */
    public function getUserById(int $userId);

    /**
     * @param UserDTO $userDTO
     * @return User
     */
    public function createUser(UserDTO $userDTO);

    /**
     * @param string $email
     * @return User|null
     */
    public function getUserByEmail(string $email): ?User;




}
