<?php

namespace App\src\Controllers;

use App\src\Models\Repository\API\APIDishesAndUserRepository;
use App\src\Models\UseCase\GetDishesUseCase;
use App\src\Views\Dishes\DishesView;
use Core\Controllers\ControllerInterface;
class GetDishesController implements ControllerInterface {
    public function control(): void
    {
        $api = new APIDishesAndUserRepository();
        $getDishesUseCase = new GetDishesUseCase($api);
        $getDishesUseCase->execute();
        
        $view= new DishesView();
        $view->render();
    }

    public static function support(string $path, string $method): bool
    {
        return $path == '/plats' && $method === 'GET';
    }
}