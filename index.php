<?php

use App\src\Views\Dishes\DishesPresenter;
use App\src\Views\Dishes\DishesView;
use App\src\Views\Dishes\CreateDishView;
use App\src\Views\Dishes\GetDishView;
use App\src\Views\Dishes\UpdateDishView;
use App\src\Views\Dishes\DeleteDishView;
use App\src\Views\Dishes\DishPresenter;

use App\src\Controllers\IndexController;
use App\src\Controllers\Dishes\GetAllDishesController;
use App\src\Controllers\Dishes\CreateDishController;
use App\src\Controllers\Dishes\GetDishController;
use App\src\Controllers\Dishes\UpdateDishController;
use App\src\Controllers\Dishes\DeleteDishController;

use App\src\Models\Repository\API\Dishes\APIDishesRepository;
use App\src\Models\UseCase\Dishes\GetDishesUseCase;
use App\src\Models\UseCase\Dishes\CreateDishUseCase;
use App\src\Models\UseCase\Dishes\GetDishUseCase;
use App\src\Models\UseCase\Dishes\UpdateDishUseCase;
use App\src\Models\UseCase\Dishes\DeleteDishUseCase;

include "Core/Includes/Autoloader.php";
\Core\Includes\Autoloader::register();

$dishRepository  = new APIDishesRepository('http://localhost:3001');
// Use Cases
$getDishesUseCase = new GetDishesUseCase($dishRepository);
$createDishUseCase = new CreateDishUseCase($dishRepository);
$getDishUseCase = new \App\src\Models\UseCase\Dishes\GetDishUseCase($dishRepository);
$updateDishUseCase = new UpdateDishUseCase($dishRepository);
$deleteDishUseCase = new DeleteDishUseCase($dishRepository);

// Views and Presenters
$dishesPresenter = new DishesPresenter($getDishesUseCase);
$dishesView      = new DishesView($dishesPresenter);

$createDishView = new CreateDishView();

$getDishView = new \App\src\Views\Dishes\GetDishView();
$updateDishView = new UpdateDishView();
$deleteDishView = new DeleteDishView();
$dishPresenter = new \App\src\Views\Dishes\DishPresenter();

// Controllers
$indexController = new IndexController();
$getAllDishesController = new GetAllDishesController($dishesView);
$createDishController = new CreateDishController($createDishUseCase, $createDishView);
$getDishController = new \App\src\Controllers\Dishes\GetDishController($getDishUseCase, $getDishView, $dishPresenter);
$updateDishController = new UpdateDishController($getDishUseCase, $updateDishUseCase, $updateDishView, $dishPresenter);
$deleteDishController = new DeleteDishController($getDishUseCase, $deleteDishUseCase, $deleteDishView, $dishPresenter);

$controllers = [$indexController, $getAllDishesController, $createDishController, $getDishController, $updateDishController, $deleteDishController];


$requestUri = $_SERVER['REQUEST_URI'] ?? '/';
$requestMethod = $_SERVER['REQUEST_METHOD'] ?? 'GET';
$path = parse_url($requestUri, PHP_URL_PATH) ?: "";

foreach ($controllers as $controller) {
    if ($controller::support($path, $requestMethod)) {
        try {
            $controller->control();
            exit();
        } catch (\Throwable $e) {

            error_log("Erreur inattendue: " . $e->getTraceAsString() . $e->getMessage());
            http_response_code(500);
            header("Location: /");
            exit();
        }
    }
}

http_response_code(404);
header("Location: /");
exit();