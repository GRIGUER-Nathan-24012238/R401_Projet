<?php

namespace App\src\Models\UseCase\Dishes;

use App\src\Models\Entities\Dishes\DishCollection;
use App\src\Models\Service\RepositoryInterface;

class GetDishesUseCase 
{
    private RepositoryInterface $repositoryInterface;

    public function __construct($repositoryInterface){
        $this->repositoryInterface = $repositoryInterface;
    }

    public function execute(): DishCollection
    {
        return $this->repositoryInterface->all();
    }


    
}