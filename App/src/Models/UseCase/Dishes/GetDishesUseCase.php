<?php

namespace App\src\Models\UseCase\Dishes;

use App\src\Models\Service\RepositoryInterface;

class GetDishesUseCase 
{
    private RepositoryInterface $repositoryInterface;

    public function __construct($repositoryInterface){
        $this->repositoryInterface = $repositoryInterface;
    }

    public function execute(): array
    {
        return $this->repositoryInterface->all();
    }


    
}