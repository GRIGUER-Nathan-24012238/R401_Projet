<?php

namespace App\src\Controllers\Dishes;

use App\src\Models\UseCase\Dishes\GetDishUseCase;
use App\src\Views\Dishes\GetDishView;
use App\src\Views\Dishes\DishPresenter;
use Core\Controllers\ControllerInterface;

/**
 * Controller to display the details of a specific dish.
 */
class GetDishController implements ControllerInterface
{
    /** @var GetDishUseCase Service to find a dish by ID */
    private GetDishUseCase $getDishUseCase;

    /** @var GetDishView The detailed view for a dish */
    private GetDishView $getDishView;

    /** @var DishPresenter Data formatter for the view */
    private DishPresenter $dishPresenter;

    /**
     * @param GetDishUseCase $getDishUseCase
     * @param GetDishView $getDishView
     * @param DishPresenter $dishPresenter
     */
    public function __construct(GetDishUseCase $getDishUseCase, GetDishView $getDishView, DishPresenter $dishPresenter)
    {
        $this->getDishUseCase = $getDishUseCase;
        $this->getDishView = $getDishView;
        $this->dishPresenter = $dishPresenter;
    }

    /**
     * Processes the request and renders the dish details.
     * 
     * @return void
     */
    public function control(): void
    {
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        if (preg_match('#^/plats/([a-zA-Z0-9\-_]+)$#', $path, $matches)) {
            $id = $matches[1];
            $dish = $this->getDishUseCase->execute($id);
            
            if ($dish) {
                $viewModel = $this->dishPresenter->present($dish);
                $this->getDishView->setDishData($viewModel);
                $this->getDishView->render();
            } else {
                http_response_code(404);
                echo "Dish not found.";
            }
        }
    }

    /**
     * Matches the path against /plats/{id}.
     * 
     * @param string $path
     * @param string $method
     * @return bool
     */
    public static function support(string $path, string $method): bool
    {
        return $method === 'GET' && preg_match('#^/plats/([a-zA-Z0-9\-_]+)$#', $path);
    }
}
