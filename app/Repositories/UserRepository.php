<?php

namespace App\Repositories;

use App\Contracts\IUserRepository;
use App\DTO\UserDTO;
use App\Exceptions\BusinessException;
use App\Exceptions\ModelNotFoundException;
use App\Exceptions\ModelAlreadyExistsException;
use App\Http\Resources\BookingsResource;
use App\Http\Resources\FeedbackResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class UserRepository implements IUserRepository
{
    /**
     * Get all users.
     *
     * @return JsonResponse
     */
    public function getUsers(): JsonResponse
    {
        $users = User::all();
        return response()->json(['data' => $users]);
    }

    /**
     * Get user by ID.
     *
     * @param int $userId
     * @return User|null
     * @throws ModelNotFoundException if the user is not found
     */
    public function getUserByID(int $userId): ?User
    {
        $user = User::query()->find($userId);
        if (!$user) {
            throw new ModelNotFoundException(__('users.user_not_found'));
        }
        return $user;
    }

    /**
     * Create a new user.
     *
     * @param UserDTO $userDTO
     * @return User
     * @throws ModelAlreadyExistsException if the user with the same email already exists
     */
    public function createUser(UserDTO $userDTO): User
    {
        $existingUser = User::where('email', $userDTO->getEmail())->first();
        if ($existingUser) {
            throw new ModelAlreadyExistsException(__('users.user_already_exists'));
        }
        try {
            $user = new User();
            $user->name = $userDTO->getName();
            $user->email = $userDTO->getEmail();
            $user->phone = $userDTO->getPhone();
            $user->password = $userDTO->getPassword();
            $user->save();

            return $user;

        } catch (\Exception $e) {
            throw new BusinessException(__('users.failed_to_create_user'));
        }
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

    public function destroyUser(int $userId): void
    {
        $user = User::query()->find($userId);
        if (!$user) {
            throw new ModelNotFoundException(__('users.user_not_found'));
        }
        $user->delete();
    }

    public function updateUser(UserDTO $userDTO, int $userId): User
    {
        $user = User::query()->find($userId);
        if (!$user) {
            throw new ModelNotFoundException(__('users.user_not_found'));
        }
        try {
            $user->name = $userDTO->getName();
            $user->email = $userDTO->getEmail();
            $user->phone = $userDTO->getPhone();
            $user->password = $userDTO->getPassword();
            $user->save();
            return $user;
        } catch (\Exception $e) {
            throw new BusinessException(__('users.failed_to_create_user'));
        }
    }

    /**
     * Get user bookings.
     *
     * @param int $userId
     * @return BookingsResource
     * @throws BusinessException if the user does not exist
     */
    public function getUserBookings(int $userId)
    {
        $user = User::query()->find($userId);
        if (!$user) {
            throw new BusinessException(__('users.user_does_not_exist'));
        }
        return BookingsResource::collection($user->bookings);
    }

    /**
     * Get user feedbacks.
     *
     * @param int $userId
     * @return FeedbackResource
     * @throws BusinessException if the user does not exist
     */
    public function getUserFeedbacks(int $userId)
    {
        $user = User::query()->find($userId);
        if (!$user) {
            throw new BusinessException(__('users.user_does_not_exist'));
        }
        return FeedbackResource::collection($user->feedbacks);
    }
}
