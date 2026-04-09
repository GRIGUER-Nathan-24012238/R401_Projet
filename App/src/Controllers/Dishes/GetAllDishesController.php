<?php

namespace App\src\Controllers\Dishes;

use App\src\Models\Repository\API\Dishes\APIDishesRepository;
use App\src\Models\UseCase\Dishes\GetDishesUseCase;
use App\src\Views\Dishes\DishesView;
use Core\Controllers\ControllerInterface;

class GetAllDishesController implements ControllerInterface {

    private GetDishesUseCase $getDishesUseCase;

    public function __construct(GetDishesUseCase $getDishesUseCase) {
        $this->getDishesUseCase = $getDishesUseCase;
    }

    public function control(): void
    {
        $dishesCollection = $this->getDishesUseCase->execute();
        
        $view = new DishesView($dishesCollection);
        $view->render();
    }
    public static function support(string $path, string $method): bool
    {
        return $path === '/plats' && $method === 'GET';
    }
}