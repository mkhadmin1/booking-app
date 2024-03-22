<?php

namespace App\Http\Controllers;

use App\DTO\UserDTO;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\Booking;
use App\Models\Feedback;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function __construct()
    {
        //
    }

    /**
     * Display a listing of the resource.
     */
    public function index(UserService $service)
    {
        return $service->getAllUsers();
    }

    /**
     * Display the specified resource.
     */
    public function show(int $userId, UserService $service)
    {
        $user = User::query()->find($userId);

        if (!$user) {
            return response()->json(['message' => __('users.user_does_not_exist')]);
        }
        $user = $service->getUserById($userId);
        return new UserResource($user);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request, UserService $service)
    {
        $userDTO = $request->validated();
        $service->createUser(UserDTO::fromArray($userDTO));
        return response()->json(['message' => __('users.user_created_success')], 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, $userId, UserService $service)
    {
        $user = User::query()->find($userId);

        if (!$user) {
            return response()->json(['message' => __('users.user_does_not_exist')]);
        }
        $service->updateUser(UserDTO::fromArray($request->validated()), $userId);
        return response()->json(['message' => __('users.user_updated_success')]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserService $service, $userId): JsonResponse
    {
        $user = User::query()->find($userId);

        if (!$user) {
            return response()->json(['message' => __('users.user_does_not_exist')]);
        }

        $service->destroyUser($userId);
        return response()->json(['message' => __('users.user_deleted_success')]);
    }

    public function showUserFeedbacks(UserService $service,int $userId)
    {
        $user = User::query()->find($userId);

        if (!$user) {
            return response()->json(['message' => __('users.user_does_not_exist')]);
        }
        return $service->getUserFeedbacks($userId);


    }

    /**
     * Get bookings associated with the specified user.
     */
    public function showUserBookings(UserService $service,int $userId)
    {
        return $service->getUserBookings($userId);
    }
}
