<?php

use App\src\Models\Repository\API\Dishes\APIDishesRepository;
use App\src\Models\UseCase\Dishes\GetDishesUseCase;

include "Core/Includes/Autoloader.php";
\Core\Includes\Autoloader::register();

use App\src\Controllers\IndexController;
use App\src\Controllers\Dishes\GetAllDishesController;

$dishRepository = new APIDishesRepository('http://localhost:3001');
$getDishesUseCase = new GetDishesUseCase($dishRepository);

$controllers = [new IndexController(), new GetAllDishesController($getDishesUseCase)];


$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?: "";

foreach ($controllers as $controller) {
    if ($controller::support($path, $_SERVER['REQUEST_METHOD'])) {
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