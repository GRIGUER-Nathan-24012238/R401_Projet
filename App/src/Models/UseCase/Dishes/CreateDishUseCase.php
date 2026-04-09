<?php

namespace App\src\Models\UseCase\Dishes;

use App\src\Models\Service\RepositoryInterface;

class CreateDishUseCase 
{
    private RepositoryInterface $repositoryInterface;

    public function __construct($repositoryInterface){
        $this->repositoryInterface = $repositoryInterface;
    }

    public function execute(\App\src\Models\Entities\Dishes\Dish $dish)
    {
        $this->repositoryInterface->save($dish);
    }
}