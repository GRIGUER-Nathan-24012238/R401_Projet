<?php

namespace App\src\Controllers\Dishes;

use App\src\Views\Dishes\DishesView;
use Core\Controllers\ControllerInterface;

/**
 * Class GetAllDishesController
 * 
 * Controller to handle the request for listing all dishes.
 * 
 * @package App\src\Controllers\Dishes
 * @author  Hernandez Loic - Griguer Nathan
 */
class GetAllDishesController implements ControllerInterface
{
    /** @var DishesView The view responsible for rendering the dishes list */
    private DishesView $dishesView;

    /**
     * @param DishesView $dishesView
     */
    public function __construct(DishesView $dishesView)
    {
        $this->dishesView = $dishesView;
    }

    /**
     * Renders the collection of dishes.
     * 
     * @return void
     */
    public function control(): void
    {
        $this->dishesView->render();
    }

    /**
     * Supports the GET request on /plats.
     * 
     * @param string $path
     * @param string $method
     * @return bool
     */
    public static function support(string $path, string $method): bool
    {
        return $path === '/plats' && $method === 'GET';
    }
}