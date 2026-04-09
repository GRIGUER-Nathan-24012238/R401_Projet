<?php

namespace App\src\Controllers\Dishes;

use App\src\Models\Entities\Dishes\Dish;
use App\src\Models\UseCase\Dishes\CreateDishUseCase;
use App\src\Views\Dishes\CreateDishView;
use Core\Controllers\ControllerInterface;

class CreateDishController implements ControllerInterface
{
    private CreateDishUseCase $createDishUseCase;
    private CreateDishView $createDishView;

    public function __construct(CreateDishUseCase $createDishUseCase, CreateDishView $createDishView)
    {
        $this->createDishUseCase = $createDishUseCase;
        $this->createDishView = $createDishView;
    }

    public function control(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->handlePost();
        } else {
            $this->handleGet();
        }
    }

    private function handleGet(): void
    {
        $this->createDishView->render();
    }

    private function handlePost(): void
    {
        $nom = $_POST['nom'] ?? '';
        $description = $_POST['description'] ?? '';
        $prix = (float) ($_POST['prix'] ?? 0);

        if ($nom && $description && $prix > 0) {
            $dish = new Dish($nom, $description, $prix);
            try {
                $this->createDishUseCase->execute($dish);
                $this->createDishView->setMessage("Ajouté avec succès");
            } catch (\Exception $e) {
                $this->createDishView->setMessage("Erreur lors de l'ajout : " . $e->getMessage());
            }
        } else {
            $this->createDishView->setMessage("Veuillez remplir tous les champs correctement.");
        }

        $this->createDishView->render();
    }

    public static function support(string $path, string $method): bool
    {
        return $path === '/plats/nouveau';
    }
}
