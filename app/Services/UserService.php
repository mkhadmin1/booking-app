<?php

namespace App\Services;

use App\Contracts\IUserRepository;
use App\DTO\UserDTO;
use App\Exceptions\BusinessException;
use App\Exceptions\ModelAlreadyExistsException;
use App\Exceptions\ModelNotFoundException;
use App\Http\Requests\User\LoginUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserService
{
    private IUserRepository $repository;

    public function __construct(IUserRepository $repository)
    {
        $this->repository = $repository;
    }


    public function getUser(int $userId)
    {
        $user = $this->repository->getUserById($userId);
        if ($user === null) {
            throw new ModelNotFoundException(__('users.user_not_found'));
        }
        return $user;
    }

    public function createUser(UserDTO $userDTO)
    {
        $existingUser = $this->repository->createUser($userDTO);
        if ($existingUser) {
            throw new ModelAlreadyExistsException(__('users.user_already_exists'));
        }
        try {
            $user = new User();
            $user->name = $userDTO->getName();
            $user->email = $userDTO->getEmail();
            $user->password = Hash::make($userDTO->getPassword());
            $user->save();

            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json(['token' => $token, 'user' => new UserResource($user)], 201);


        } catch (\Exception $e) {
            throw new BusinessException(__('users.failed_to_create_user'));
        }
    }

    public function login(LoginUserRequest $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json(['token' => $token], 200);
        } else {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
    }

    public function logout()
    {
        Auth::user()->tokens()->delete();

        return response()->json(['message' => __('users.user_logout')], 200);
    }

}
