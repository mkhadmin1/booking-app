<?php

namespace App\Repositories;

use App\Contracts\IUserRepository;
use App\DTO\UserDTO;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class UserRepository implements IUserRepository
{
    public function getUserByID(int $userId): ?User
    {
        /**
         * @var User|null $user
         */
        $user = User::query()->find($userId);
        return $user;
    }

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

    public function getUserByEmail(string $email): ?User
    {
        /**@var User|null $user*/
        $user = User::query()->where('email', $email)->first();
        return $user;
    }
    public function getUsers(): JsonResponse
    {
        /** @var array $users */
        $users = User::all();

        return response()->json([
            'data' => $users
        ]);

    }

    public function destroyUser(int $userId)
    {
        $user = User::query()->find($userId);
        $user->delete();
        return response()->json(['message' => __('users.user_deleted_success')]);


    }

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

}
