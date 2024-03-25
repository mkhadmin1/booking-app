<?php

namespace App\Http\Controllers\User;

use App\DTO\UserDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function __construct()
    {
        //
    }

    /**
     * @param UserService $service
     * @return mixed
     */
    public function index(UserService $service)
    {
        return $service->getAllUsers();
    }

    /**
     * @param int $userId
     * @param UserService $service
     * @return mixed
     */
    public function show(int $userId, UserService $service)
    {
        return $service->getUserById($userId);
    }

    /**
     * @param StoreUserRequest $request
     * @param UserService $service
     * @return JsonResponse
     */
    public function store(StoreUserRequest $request, UserService $service)
    {
        $userDTO = $request->validated();
        $service->createUser(UserDTO::fromArray($userDTO));
        return response()->json(['message' => __('users.user_created_success')], 201);
    }

    /**
     * @param UpdateUserRequest $request
     * @param int $userId
     * @param UserService $service
     * @return JsonResponse
     */
    public function update(UpdateUserRequest $request, $userId, UserService $service)
    {
        $service->updateUser(UserDTO::fromArray($request->validated()), $userId);
        return response()->json(['message' => __('users.user_updated_success')]);
    }

    /**
     * @param UserService $service
     * @param int $userId
     * @return JsonResponse
     */
    public function destroy(UserService $service, $userId): JsonResponse
    {
        $service->destroyUser($userId);
        return response()->json(['message' => __('users.user_deleted_success')]);
    }

    /**
     * @param UserService $service
     * @param int $userId
     * @return mixed
     */
    public function showUserFeedbacks(UserService $service, int $userId)
    {
        return $service->getUserFeedbacks($userId);
    }

    /**
     * Get bookings associated with the specified user.
     *
     * @param UserService $service
     * @param int $userId
     * @return mixed
     */
    public function showUserBookings(UserService $service, int $userId)
    {
        return $service->getUserBookings($userId);
    }
}
