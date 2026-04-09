<?php

namespace App\src\Models\UseCase\Dishes;

use App\src\Controllers\Dishes\DishesPresenter;
use App\src\Models\Entities\Dishes\DishCollection;
use App\src\Models\Repository\API\Dishes\Factory\DishesFactory;
use App\src\Models\Service\RepositoryInterface;
class GetDishesUseCase 
{
    private RepositoryInterface $repositoryInterface;
    private DishesPresenter $dishesPresenter;

    public function __construct($repositoryInterface){
        $this->repositoryInterface = $repositoryInterface;
    }

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