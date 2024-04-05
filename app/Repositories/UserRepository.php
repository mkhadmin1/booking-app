<?php

namespace App\Repositories;

use App\Contracts\IUserRepository;
use App\DTO\UserDTO;
use App\Exceptions\BusinessException;
use App\Exceptions\ModelNotFoundException;
use App\Exceptions\ModelAlreadyExistsException;
use App\Http\Resources\BookingsResource;
use App\Http\Resources\FeedbackResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class UserRepository implements IUserRepository
{

    public function getUserByID(int $userId)
    {
        return User::query()
            ->with(['bookings', 'feedbacks'])
            ->where('id', $userId)->first();
    }

    /**
     * Create a new user.
     *
     * @param UserDTO $userDTO
     * @return User
     * @throws ModelAlreadyExistsException if the user with the same email already exists
     */
    public function findByEmail(string $email)
    {
        return User::where('email', $email)->first();
    }

//    public function getUserByEmail(string $email): ?User
//    {
//        $user = User::query()->where('email', $email)->first();
//
//        return $user;
//    }

}
