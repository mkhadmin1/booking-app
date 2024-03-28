<?php

namespace App\Http\Controllers\Auth;

use App\DTO\UserDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\LoginUserRequest;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function register(StoreUserRequest $request, UserService $service)
    {
        $userDTO = $request->validated();
        return $service->createUser(UserDTO::fromArray($userDTO));
    }


    public function login(LoginUserRequest $request, UserService $service)
    {
        return $service->login($request);
    }


    public function logout(UserService $service) {
        return $service->logout();
    }

}
