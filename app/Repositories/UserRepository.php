<?php

namespace App\Repositories;

use App\Contracts\IUserRepository;
use App\DTO\UserDTO;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 *
 */
class UserRepository implements IUserRepository
{
    /**
     * @param int $userId
     * @return User|null
     */
    public function getUserByID(int $userId): ?User
    {
        /**
         * @var User|null $user
         */
        $user = User::query()->find($userId);
        return $user;
    }

    /**
     * @param UserDTO $userDTO
     * @return User
     */
    public function createUser(UserDTO $userDTO): User
    {
        $user = new User();
        $user->name = $userDTO->getName();
        $user->email = $userDTO->getEmail();
        $user->phone = $userDTO->getPhone();
        $user->password = $userDTO->getPassword();
        $user->save();

        return $user;


    }

    /**
     * @param string $email
     * @return User|null
     */
    public function getUserByEmail(string $email): ?User
    {
        /**@var User|null $user*/
        $user = User::query()->where('email', $email)->first();
        return $user;
    }

    /**
     * @return JsonResponse
     */
    public function getUsers(): JsonResponse
    {
        /** @var array $users */
        $users = User::all();

        return response()->json([
            'data' => $users
        ]);

    }

    /**
     * @param int $userId
     * @return JsonResponse|mixed
     */
    public function destroyUser(int $userId)
    {
        $user = User::query()->find($userId);
        $user->delete();
        return response()->json(['message' => __('users.user_deleted_success')]);


    }

    /**
     * @param UserDTO $userDTO
     * @param int $userId
     * @return User
     */
    public function updateUser(UserDTO $userDTO, int $userId): User
    {
        /** @var User $user */
        $user = User::query()->find($userId);

        $user->name = $userDTO->getName();
        $user->email = $userDTO->getEmail();
        $user->phone = $userDTO->getPhone();
        $user->password = $userDTO->getPassword();
        $user->update();

        return $user;
    }


    /**
     * @param int $userId
     * @return JsonResponse|AnonymousResourceCollection
     */
    public function getUserBookings(int $userId)
    {
        $user = User::query()->find($userId);
        if (!$user) {
            return response()->json(['message' => __('users.user_does_not_exist')]);
        }
        return UserResource::collection($user->bookings);

    }

    /**
     * @param int $userId
     * @return JsonResponse|AnonymousResourceCollection
     */
    public function getUserFeedbacks(int $userId)
    {
        $user = User::query()->find($userId);
        if (!$user) {
            return response()->json(['message' => __('users.user_does_not_exist')]);
        }
        return FeedbackResource::collection($user->feedbacks);
    }

}
