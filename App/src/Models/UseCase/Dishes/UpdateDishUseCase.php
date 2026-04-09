<?php

namespace App\src\Models\UseCase\Dishes;

use App\src\Models\Entities\Dishes\Dish;
use App\src\Models\Service\RepositoryInterface;

/**
 * Class UpdateDishUseCase
 * 
 * Use case to update an existing dish.
 * 
 * @package App\src\Models\UseCase\Dishes
 * @author  Hernandez Loic - Griguer Nathan
 */
class UpdateDishUseCase
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
     * Executes the use case to update a dish.
     * 
     * @param string $id The current identifier of the dish
     * @param Dish $dish The new dish data
     * @return mixed The update result
     */
    public function execute(string $id, Dish $dish)
    {
        return $this->repository->update($id, $dish);
    }
}