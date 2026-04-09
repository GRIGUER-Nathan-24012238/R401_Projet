<?php

namespace App\src\Controllers\Dishes;

use App\src\Views\Dishes\DishesView;
use Core\Controllers\ControllerInterface;

class GetAllDishesController implements ControllerInterface
{
    private DishesView $dishesView;

    public function __construct(DishesView $dishesView)
    {
        $this->dishesView = $dishesView;
    }

    public function control(): void
    {
        $this->dishesView->render();
    }

    public static function support(string $path, string $method): bool
    {
        return $path === '/plats' && $method === 'GET';
    }
}