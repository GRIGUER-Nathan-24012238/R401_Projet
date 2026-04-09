<?php

namespace App\src\Models\UseCase\Dishes;

use App\src\Models\Service\RepositoryInterface;

/**
 * Class CreateDishUseCase
 * 
 * Use case to create a new dish in the catalogue.
 * 
 * @package App\src\Models\UseCase\Dishes
 * @author  Hernandez Loic - Griguer Nathan
 */
class CreateDishUseCase 
{
    /** @var RepositoryInterface The repository for dish data */
    private RepositoryInterface $repositoryInterface;

    /**
     * @param RepositoryInterface $repositoryInterface
     */
    public function __construct($repositoryInterface){
        $this->repositoryInterface = $repositoryInterface;
    }

    /**
     * Executes the use case to save a new dish.
     * 
     * @param \App\src\Models\Entities\Dishes\Dish $dish The dish entity to persist
     * @return void
     */
    public function execute(\App\src\Models\Entities\Dishes\Dish $dish)
    {
        $this->repositoryInterface->save($dish);
    }
}