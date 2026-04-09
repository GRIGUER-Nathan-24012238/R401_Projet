<?php

namespace App\src\Models\UseCase\Users;

use App\src\Models\Service\RepositoryInterface;

class GetUsersUseCase
{
    private RepositoryInterface $repository;

    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function execute()
    {
        return $this->repository->all();
    }
}
