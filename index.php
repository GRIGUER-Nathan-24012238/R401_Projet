<?php

use App\src\Views\Dishes\DishesPresenter;
use App\src\Views\Dishes\DishesView;
use App\src\Views\Dishes\CreateDishView;
use App\src\Views\Dishes\GetDishView;
use App\src\Views\Dishes\UpdateDishView;
use App\src\Views\Dishes\DeleteDishView;
use App\src\Views\Dishes\DishPresenter;

use App\src\Views\Users\UsersView;
use App\src\Views\Users\GetUserView;
use App\src\Views\Users\CreateUserView;
use App\src\Views\Users\UpdateUserView;
use App\src\Views\Users\DeleteUserView;
use App\src\Views\Users\UserPresenter;
use App\src\Views\Users\UsersPresenter;

use App\src\Controllers\IndexController;
use App\src\Controllers\Dishes\GetAllDishesController;
use App\src\Controllers\Dishes\CreateDishController;
use App\src\Controllers\Dishes\GetDishController;
use App\src\Controllers\Dishes\UpdateDishController;
use App\src\Controllers\Dishes\DeleteDishController;

use App\src\Controllers\Users\GetAllUsersController;
use App\src\Controllers\Users\GetUserController;
use App\src\Controllers\Users\CreateUserController;
use App\src\Controllers\Users\UpdateUserController;
use App\src\Controllers\Users\DeleteUserController;

use App\src\Models\Repository\API\Dishes\APIDishesRepository;
use App\src\Models\Repository\API\Users\APIUsersRepository;

use App\src\Models\UseCase\Dishes\GetDishesUseCase;
use App\src\Models\UseCase\Dishes\CreateDishUseCase;
use App\src\Models\UseCase\Dishes\GetDishUseCase;
use App\src\Models\UseCase\Dishes\UpdateDishUseCase;
use App\src\Models\UseCase\Dishes\DeleteDishUseCase;

use App\src\Models\UseCase\Users\GetUsersUseCase;
use App\src\Models\UseCase\Users\GetUserUseCase;
use App\src\Models\UseCase\Users\CreateUserUseCase;
use App\src\Models\UseCase\Users\UpdateUserUseCase;
use App\src\Models\UseCase\Users\DeleteUserUseCase;

include "Core/Includes/Autoloader.php";
\Core\Includes\Autoloader::register();

$apiBaseUrl = 'http://localhost:3001';
$dishRepository  = new APIDishesRepository($apiBaseUrl);
$userRepository  = new APIUsersRepository($apiBaseUrl);
// Use Cases
$getDishesUseCase = new \App\src\Models\UseCase\Dishes\GetDishesUseCase($dishRepository);
$createDishUseCase = new \App\src\Models\UseCase\Dishes\CreateDishUseCase($dishRepository);
$getDishUseCase = new \App\src\Models\UseCase\Dishes\GetDishUseCase($dishRepository);
$updateDishUseCase = new \App\src\Models\UseCase\Dishes\UpdateDishUseCase($dishRepository);
$deleteDishUseCase = new \App\src\Models\UseCase\Dishes\DeleteDishUseCase($dishRepository);

$getUsersUseCase = new \App\src\Models\UseCase\Users\GetUsersUseCase($userRepository);
$getUserUseCase = new \App\src\Models\UseCase\Users\GetUserUseCase($userRepository);
$createUserUseCase = new \App\src\Models\UseCase\Users\CreateUserUseCase($userRepository);
$updateUserUseCase = new \App\src\Models\UseCase\Users\UpdateUserUseCase($userRepository);
$deleteUserUseCase = new \App\src\Models\UseCase\Users\DeleteUserUseCase($userRepository);

// Views and Presenters
// Presenters
$dishesPresenter = new \App\src\Views\Dishes\DishesPresenter($getDishesUseCase);
$dishPresenter = new \App\src\Views\Dishes\DishPresenter();
$usersPresenter = new \App\src\Views\Users\UsersPresenter($getUsersUseCase);
$userPresenter = new \App\src\Views\Users\UserPresenter();

// Views
$dishesView = new \App\src\Views\Dishes\DishesView($dishesPresenter);
$createDishView = new \App\src\Views\Dishes\CreateDishView();
$getDishView = new \App\src\Views\Dishes\GetDishView();
$updateDishView = new \App\src\Views\Dishes\UpdateDishView();
$deleteDishView = new \App\src\Views\Dishes\DeleteDishView();

$usersView = new \App\src\Views\Users\UsersView();
$getUserView = new \App\src\Views\Users\GetUserView();
$createUserView = new \App\src\Views\Users\CreateUserView();
$updateUserView = new \App\src\Views\Users\UpdateUserView();
$deleteUserView = new \App\src\Views\Users\DeleteUserView();

// Controllers
$indexController = new \App\src\Controllers\IndexController();
$getAllDishesController = new \App\src\Controllers\Dishes\GetAllDishesController($dishesView);
$createDishController = new \App\src\Controllers\Dishes\CreateDishController($createDishUseCase, $createDishView);
$getDishController = new \App\src\Controllers\Dishes\GetDishController($getDishUseCase, $getDishView, $dishPresenter);
$updateDishController = new \App\src\Controllers\Dishes\UpdateDishController($getDishUseCase, $updateDishUseCase, $updateDishView, $dishPresenter);
$deleteDishController = new \App\src\Controllers\Dishes\DeleteDishController($getDishUseCase, $deleteDishUseCase, $deleteDishView, $dishPresenter);

$getAllUsersController = new \App\src\Controllers\Users\GetAllUsersController($usersView, $usersPresenter);
$getUserController = new \App\src\Controllers\Users\GetUserController($getUserUseCase, $getUserView, $userPresenter);
$createUserController = new \App\src\Controllers\Users\CreateUserController($createUserUseCase, $createUserView);
$updateUserController = new \App\src\Controllers\Users\UpdateUserController($getUserUseCase, $updateUserUseCase, $updateUserView, $userPresenter);
$deleteUserController = new \App\src\Controllers\Users\DeleteUserController($getUserUseCase, $deleteUserUseCase, $deleteUserView, $userPresenter);

$controllers = [
    $indexController, 
    $getAllDishesController, 
    $createDishController, 
    $getDishController, 
    $updateDishController, 
    $deleteDishController,
    $getAllUsersController,
    $createUserController,
    $getUserController,
    $updateUserController,
    $deleteUserController
];


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