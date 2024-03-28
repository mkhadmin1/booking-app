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
        $user = User::query()->find($userId);
        if (!$user) {
            throw new ModelNotFoundException(__('users.user_not_found'));
        }
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
    public function createUser(UserDTO $userDTO)
    {
        $existingUser = User::where('email', $userDTO->getEmail())->first();
        return $existingUser;

    }

    public function getUserByEmail(string $email): ?User
    {
        $user = User::query()->where('email', $email)->first();
        if (!$user) {
            throw new ModelNotFoundException(__('users.user_not_found'));
        }
        /** @var User $user */
        return $user;
    }

}
