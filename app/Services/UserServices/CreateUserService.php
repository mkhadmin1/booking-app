<?php

namespace App\Services\UserServices;

use App\Contracts\IUserRepository;
use App\DTO\UserDTO;
use App\Exceptions\BusinessExceptions;
use App\Models\User;
use App\Repositories\UserRepository;

class CreateUserService
{

    public function __construct(private readonly IUserRepository $repository)
    {


    }

    /**
     * @throws BusinessExceptions
     */
    public function execute(UserDTO $userDTO): User
    {
        $userWithEmail = $this->repository->getUserByEmail($userDTO->getEmail());
        if ($userWithEmail!== null){
            throw new BusinessExceptions(__('msg.email_exists'));
        }

        return $this->repository->createUser($userDTO);

    }

}
