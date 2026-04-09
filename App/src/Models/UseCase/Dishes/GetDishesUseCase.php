<?php

namespace App\src\Models\UseCase\Dishes;

use App\src\Controllers\Dishes\DishesPresenter;
use App\src\Models\Entities\Dishes\DishCollection;
use App\src\Models\Repository\API\Dishes\Factory\DishesFactory;
use App\src\Models\Service\RepositoryInterface;
/**
 * Class GetDishesUseCase
 * 
 * Use case to retrieve the list of all dishes.
 * 
 * @package App\src\Models\UseCase\Dishes
 * @author  Hernandez Loic - Griguer Nathan
 */
class GetDishesUseCase 
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
     * Executes the use case to retrieve all dishes.
     * 
     * @return DishCollection A collection of all dishes
     */
    public function execute(): DishCollection
    {
        $data = $this->repositoryInterface->all();

        $collection = new DishCollection();

        foreach ($data as $item) {
            $collection->add(DishesFactory::fromArray($item));
        }
        return $collection;
    }


    
}