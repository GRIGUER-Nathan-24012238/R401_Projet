<?php

namespace App\src\Models\UseCase\Dishes;

use App\src\Models\Service\RepositoryInterface;

class DeleteDishUseCase
{
    private RepositoryInterface $repository;

    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function execute(string $id): void
    {
        $this->repository->delete($id);
    }
}