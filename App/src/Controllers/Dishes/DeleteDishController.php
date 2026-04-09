<?php

namespace App\src\Controllers\Dishes;

use App\src\Models\UseCase\Dishes\GetDishUseCase;
use App\src\Models\UseCase\Dishes\DeleteDishUseCase;
use App\src\Views\Dishes\DeleteDishView;
use App\src\Views\Dishes\DishPresenter;
use Core\Controllers\ControllerInterface;

class DeleteDishController implements ControllerInterface
{
    private GetDishUseCase $getDishUseCase;
    private DeleteDishUseCase $deleteDishUseCase;
    private DeleteDishView $deleteDishView;
    private DishPresenter $dishPresenter;

    public function __construct(
        GetDishUseCase $getDishUseCase, 
        DeleteDishUseCase $deleteDishUseCase, 
        DeleteDishView $deleteDishView, 
        DishPresenter $dishPresenter
    ) {
        $this->getDishUseCase = $getDishUseCase;
        $this->deleteDishUseCase = $deleteDishUseCase;
        $this->deleteDishView = $deleteDishView;
        $this->dishPresenter = $dishPresenter;
    }

    public function control(): void
    {
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $method = $_SERVER['REQUEST_METHOD'];

        if (preg_match('#^/plats/([a-zA-Z0-9\-_]+)/supprimer$#', $path, $matches)) {
            $id = $matches[1];
            
            if ($method === 'GET') {
                $this->showConfirmation($id);
            } elseif ($method === 'POST') {
                $this->processDeletion($id);
            }
        }
    }

    private function showConfirmation(string $id): void
    {
        $dish = $this->getDishUseCase->execute($id);
        if ($dish) {
            $viewModel = $this->dishPresenter->present($dish);
            $this->deleteDishView->setDishData($viewModel);
            $this->deleteDishView->render();
        } else {
            http_response_code(404);
            echo "Plat non trouvé pour suppression.";
        }
    }

    private function processDeletion(string $id): void
    {
        try {
            $this->deleteDishUseCase->execute($id);
            header('Location: /plats');
            exit();
        } catch (\Exception $e) {
            http_response_code(500);
            echo "Erreur lors de la suppression du plat : " . $e->getMessage();
        }
    }

    public static function support(string $path, string $method): bool
    {
        return preg_match('#^/plats/([a-zA-Z0-9\-_]+)/supprimer$#', $path);
    }
}
