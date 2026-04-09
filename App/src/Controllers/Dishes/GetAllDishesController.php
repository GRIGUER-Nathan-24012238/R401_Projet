<?php

namespace App\src\Controllers\Dishes;

use App\src\Models\Repository\API\Dishes\APIDishesRepository;
use App\src\Models\UseCase\Dishes\GetDishesUseCase;
use App\src\Views\Dishes\DishesView;
use Core\Controllers\ControllerInterface;

class GetAllDishesController implements ControllerInterface {
    public function control(): void
    {
        $api = new APIDishesRepository();
        $getDishesUseCase = new GetDishesUseCase($api);
        $dishes =  $getDishesUseCase->execute();

        $view= new DishesView($dishes);
        $view->render();
    }

    public static function support(string $path, string $method): bool
    {
        return $path === '/plats' && $method === 'GET';
    }
}