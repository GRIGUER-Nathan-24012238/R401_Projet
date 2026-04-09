<?php

use App\src\Controllers\Dishes\GetAllDishesController;

include "Core/Includes/Autoloader.php";
\Core\Includes\Autoloader::register();

use App\src\Controllers\IndexController;

$controllers = [new IndexController(), new GetAllDishesController()];


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