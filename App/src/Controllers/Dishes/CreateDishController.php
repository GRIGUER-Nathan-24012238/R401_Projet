<?php

namespace App\src\Controllers\Dishes;

use App\src\Models\Entities\Dishes\Dish;
use App\src\Models\UseCase\Dishes\CreateDishUseCase;
use App\src\Views\Dishes\CreateDishView;
use Core\Controllers\ControllerInterface;

/**
 * Class CreateDishController
 * 
 * Controller for creating new dishes.
 * 
 * Handles both the display of the creation form and the processing of the form submission.
 * 
 * @package App\src\Controllers\Dishes
 * @author  Hernandez Loic - Griguer Nathan
 */
class CreateDishController implements ControllerInterface
{
    /** @var CreateDishUseCase Service to handle dish persistence */
    private CreateDishUseCase $createDishUseCase;

    /** @var CreateDishView View for the creation form */
    private CreateDishView $createDishView;

    /**
     * @param CreateDishUseCase $createDishUseCase
     * @param CreateDishView $createDishView
     */
    public function __construct(CreateDishUseCase $createDishUseCase, CreateDishView $createDishView)
    {
        $this->createDishUseCase = $createDishUseCase;
        $this->createDishView = $createDishView;
    }

    /**
     * Routes the request to either display the form or handle its submission.
     * 
     * @return void
     */
    public function control(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->handlePost();
        } else {
            $this->handleGet();
        }
    }

    /**
     * Displays the empty creation form.
     * 
     * @return void
     */
    private function handleGet(): void
    {
        $this->createDishView->render();
    }

    /**
     * Processes the form submission and saves the new dish.
     * 
     * @return void
     */
    private function handlePost(): void
    {
        $nom = $_POST['nom'] ?? '';
        $description = $_POST['description'] ?? '';
        $prix = (float) ($_POST['prix'] ?? 0);

        if ($nom && $description && $prix > 0) {
            $dish = new Dish($nom, $description, $prix);
            try {
                $this->createDishUseCase->execute($dish);
                $this->createDishView->setMessage("Dish added successfully.");
            } catch (\Exception $e) {
                $this->createDishView->setMessage("Error while adding: " . $e->getMessage());
            }
        } else {
            $this->createDishView->setMessage("Please fill all fields correctly.");
        }

        $this->createDishView->render();
    }

    /**
     * Matches the path /plats/nouveau.
     * 
     * @param string $path
     * @param string $method
     * @return bool
     */
    public static function support(string $path, string $method): bool
    {
        return $path === '/plats/nouveau';
    }
}
