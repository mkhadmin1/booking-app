<?php

namespace App\Repositories;

use App\Contracts\IUserRepository;
use App\DTO\UserDTO;
use App\Models\User;

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

}
