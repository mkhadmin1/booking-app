<?php

namespace App\Http\Controllers\User;

use App\DTO\UserDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\LoginUserRequest;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        //
    }

    public function me(UserService $service)
    {
        $user = Auth::user();

        return $service->getUser($user->id);
    }



}
