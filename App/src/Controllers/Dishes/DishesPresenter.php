<?php

namespace App\src\Controllers\Dishes;

use App\src\Models\UseCase\Dishes\GetDishesUseCase;

class DishesPresenter 
{
    private GetDishesUseCase $getDishesService;

    public function __construct(GetDishesUseCase $getDishesService)
    {
        $this->getDishesService = $getDishesService;
    }


    public function present(): array
    {
        $dishes = $this->getDishesService->execute();
        
        $viewModels = [];

        foreach ($dishes as $item) {
            $viewModels[] = [
                'nom' => htmlspecialchars($item->nom),
                'description' => htmlspecialchars($item->description),
                'prix' => number_format($item->prix, 2, ',', ' ') . ' €'
            ];
        }

        return $viewModels;
    }
}