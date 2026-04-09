<?php

namespace App\src\Models\UseCase\Dishes;

use App\src\Models\Entities\Dishes\Dish;
use App\src\Models\Service\RepositoryInterface;
/**
 * Class GetDishUseCase
 * 
 * Use case to retrieve a single dish by its identifier.
 * 
 * @package App\src\Models\UseCase\Dishes
 * @author  Hernandez Loic - Griguer Nathan
 */
class GetDishUseCase
{
    /** @var RepositoryInterface The repository for dish data */
    private RepositoryInterface $repository;

    /**
     * @param RepositoryInterface $repository
     */
    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Executes the use case to find a dish.
     * 
     * @param string $id The unique identifier of the dish
     * @return Dish|null The found dish or null if not found
     */
    public function execute(string $id): ?Dish
    {
        return $this->repository->find($id);
    }
}