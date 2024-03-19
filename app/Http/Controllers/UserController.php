<?php

namespace App\Http\Controllers;

use App\Contracts\IUserRepository;
use App\DTO\UserDTO;
use App\Exceptions\BusinessExceptions;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Services\UserServices\CreateUserService;
use Illuminate\Http\JsonResponse;


/**
 *
 */
class UserController extends Controller
{

    private IUserRepository $repository;


    public function __construct()
    {
        $this->repository = new UserRepository();
    }

    public function index(): JsonResponse
    {
        $users = User::all();
        return response()->json([
            'data' => $users
        ]);
    }


    /**
     * @param UserRequest $request
     * @param CreateUserService $service
     * @return UserResource
     * @throws BusinessExceptions
     */

    public function store(UserRequest $request, CreateUserService $service): UserResource
    {
        $validatedData = $request->validated();
        $user = $service->execute(UserDTO::fromArray($validatedData));

        return new UserResource($user);
    }

    public function show(int $id): UserResource
    {

        $user = $this->repository->getUserById($id);

        return new UserResource($user);
    }

    public function update(UserRequest $request, User $user): UserResource
    {
        $validatedData = $request->validated();

        $user->update($validatedData);

        return new UserResource($user);
    }

    public function destroy(User $user): JsonResponse
    {
        $user->delete();

        return response()->json(['message' => 'Record successfully deleted']);
    }
}

