<?php

namespace App\src\Views\Dishes;

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
                'nom' => htmlspecialchars($item->getName()),
                'description' => htmlspecialchars($item->getDescription()),
                'prix' => number_format($item->getPrix(), 2, ',', ' ') . ' €'
            ];
        }

        return $viewModels;
    }
}
