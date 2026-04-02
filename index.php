<?php

include "Core/Includes/Autoloader.php";
\Core\Includes\Autoloader::register();

use App\src\Controllers\MainController;
use Core\Services\SessionService;


$controllers = [new MainController()];


$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?: "";

foreach ($controllers as $controller) {
    if ($controller::support($path, $_SERVER['REQUEST_METHOD'])) {
        try {
            $controller->control();
            exit();
        } catch (\Throwable $e) {

            SessionService::setFlash('errors', ["Une erreur inattendue est survenue."]);
            error_log("Erreur inattendue: " . $e->getTraceAsString() . $e->getMessage());
            http_response_code(500);
            header("Location: /");
            exit();
        }
    }
}

// 404 - Route not found
http_response_code(404);
SessionService::setFlash('errors', "Page non existante.");
header("Location: /");
exit();

$mainController = new MainController();
$mainController->control();