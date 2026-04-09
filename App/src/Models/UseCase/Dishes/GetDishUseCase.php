<?php

namespace App\src\Models\UseCase\Dishes;

use App\src\Models\Entities\Dishes\Dish;
use App\src\Models\Service\RepositoryInterface;
class GetDishUseCase
{
    private RepositoryInterface $repository;

    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function execute(int $id): Dish
    {
        return $this->repository->find($id);
    }
}