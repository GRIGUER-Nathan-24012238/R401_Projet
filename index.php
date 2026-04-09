<?php

use App\src\Views\Dishes\DishesPresenter;
use App\src\Controllers\Dishes\GetAllDishesController;
use App\src\Controllers\IndexController;
use App\src\Models\Repository\API\Dishes\APIDishesRepository;
use App\src\Models\UseCase\Dishes\GetDishesUseCase;
use App\src\Models\UseCase\Dishes\CreateDishUseCase;
use App\src\Views\Dishes\DishesView;
use App\src\Views\Dishes\CreateDishView;
use App\src\Controllers\Dishes\CreateDishController;

include "Core/Includes/Autoloader.php";
\Core\Includes\Autoloader::register();

$dishRepository  = new APIDishesRepository('http://localhost:3001');
$getDishesUseCase = new GetDishesUseCase($dishRepository);
$dishesPresenter = new DishesPresenter($getDishesUseCase);
$dishesView      = new DishesView($dishesPresenter);

$createDishUseCase = new CreateDishUseCase($dishRepository);
$createDishView = new CreateDishView();
$createDishController = new CreateDishController($createDishUseCase, $createDishView);

$controllers = [new IndexController(), new GetAllDishesController($dishesView), $createDishController];


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