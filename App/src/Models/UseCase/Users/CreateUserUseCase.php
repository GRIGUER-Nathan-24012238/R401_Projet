<?php

namespace App\src\Models\UseCase\Users;

use App\src\Models\Entities\Users\User;
use App\src\Models\Service\RepositoryInterface;

class CreateUserUseCase
{
    private RepositoryInterface $repository;

    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function execute(User $user)
    {
        return $this->repository->save($user);
    }
}
