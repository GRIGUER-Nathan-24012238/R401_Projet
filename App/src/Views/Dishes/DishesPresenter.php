<?php

namespace App\src\Views\Dishes;

use App\src\Models\UseCase\Dishes\GetDishesUseCase;

/**
 * Class DishesPresenter
 * 
 * Presenter for listing multiple dishes.
 * 
 * Orchestrates the retrieval and formatting of all dishes for the collection view.
 * 
 * @package App\src\Views\Dishes
 * @author  Hernandez Loic - Griguer Nathan
 */
class DishesPresenter 
{
    /** @var GetDishesUseCase Internal service to fetch dishes */
    private GetDishesUseCase $getDishesService;

    /**
     * @param GetDishesUseCase $getDishesService
     */
    public function __construct(GetDishesUseCase $getDishesService)
    {
        $this->getDishesService = $getDishesService;
    }


    /**
     * Retrieves and formats all dishes for listing.
     * 
     * @return array<int, array<string, mixed>> List of formatted dishes
     */
    public function present(): array
    {
        $dishes = $this->getDishesService->execute();
        
        $viewModels = [];

        foreach ($dishes as $item) {
            $viewModels[] = [
                'id' => $item->getId(),
                'nom' => htmlspecialchars($item->getName()),
                'description' => htmlspecialchars($item->getDescription()),
                'prix' => number_format($item->getPrix(), 2, ',', ' ')
            ];
        }

        return $viewModels;
    }
}
