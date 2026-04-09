<?php

namespace App\src\Controllers\Dishes;

use App\src\Models\UseCase\Dishes\GetDishUseCase;
use App\src\Views\Dishes\GetDishView;
use App\src\Views\Dishes\DishPresenter;
use Core\Controllers\ControllerInterface;

class GetDishController implements ControllerInterface
{
    private GetDishUseCase $getDishUseCase;
    private GetDishView $getDishView;
    private DishPresenter $dishPresenter;

    public function __construct(GetDishUseCase $getDishUseCase, GetDishView $getDishView, DishPresenter $dishPresenter)
    {
        $this->getDishUseCase = $getDishUseCase;
        $this->getDishView = $getDishView;
        $this->dishPresenter = $dishPresenter;
    }

    public function control(): void
    {
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        if (preg_match('#^/plats/(\d+)$#', $path, $matches)) {
            $id = (int) $matches[1];
            $dish = $this->getDishUseCase->execute($id);
            
            if ($dish) {
                $viewModel = $this->dishPresenter->present($dish);
                $this->getDishView->setDishData($viewModel);
                $this->getDishView->render();
            } else {
                http_response_code(404);
                echo "Plat non trouvé.";
            }
        }
    }

    public static function support(string $path, string $method): bool
    {
        return $method === 'GET' && preg_match('#^/plats/(\d+)$#', $path);
    }
}
