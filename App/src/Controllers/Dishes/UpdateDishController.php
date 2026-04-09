<?php

namespace App\src\Controllers\Dishes;

use App\src\Models\UseCase\Dishes\GetDishUseCase;
use App\src\Models\UseCase\Dishes\UpdateDishUseCase;
use App\src\Models\Entities\Dishes\Dish;
use App\src\Views\Dishes\UpdateDishView;
use App\src\Views\Dishes\DishPresenter;
use Core\Controllers\ControllerInterface;

class UpdateDishController implements ControllerInterface
{
    private GetDishUseCase $getDishUseCase;
    private UpdateDishUseCase $updateDishUseCase;
    private UpdateDishView $updateDishView;
    private DishPresenter $dishPresenter;

    public function __construct(
        GetDishUseCase $getDishUseCase, 
        UpdateDishUseCase $updateDishUseCase, 
        UpdateDishView $updateDishView, 
        DishPresenter $dishPresenter
    ) {
        $this->getDishUseCase = $getDishUseCase;
        $this->updateDishUseCase = $updateDishUseCase;
        $this->updateDishView = $updateDishView;
        $this->dishPresenter = $dishPresenter;
    }

    public function control(): void
    {
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $method = $_SERVER['REQUEST_METHOD'];
        
        if (preg_match('#^/plats/([a-zA-Z0-9\-_]+)/modifier$#', $path, $matches)) {
            $id = $matches[1];

            if ($method === 'GET') {
                $this->showForm($id);
            } elseif ($method === 'POST') {
                $this->processUpdate($id);
            }
        }
    }

    private function showForm(string $id): void
    {
        $dish = $this->getDishUseCase->execute($id);
        if ($dish) {
            $viewModel = $this->dishPresenter->present($dish);
            $this->updateDishView->setDishData($viewModel);
            $this->updateDishView->render();
        } else {
            http_response_code(404);
            echo "Plat non trouvé pour modification.";
        }
    }

    private function processUpdate(string $id): void
    {
        $nom = $_POST['nom'] ?? '';
        $description = $_POST['description'] ?? '';
        $prix = (float) ($_POST['prix'] ?? 0);

        if ($nom && $description && $prix) {
            $dish = new Dish($nom, $description, $prix);
            $this->updateDishUseCase->execute($id, $dish);
            
            header('Location: /plats/' . $id);
            exit();
        } else {
            echo "Veuillez remplir tous les champs.";
        }
    }

    public static function support(string $path, string $method): bool
    {
        return preg_match('#^/plats/([a-zA-Z0-9\-_]+)/modifier$#', $path);
    }
}
