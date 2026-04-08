<?php

namespace App\src\Models\UseCase;

use App\src\Models\Service\RepositoryInterface;

class CreateDishesUseCase 
{
    private RepositoryInterface $repositoryInterface;

    public function __construct($repositoryInterface){
        $this->repositoryInterface = $repositoryInterface;
    }

    public function execute()
    {
        $this->repositoryInterface->all();
    }
}