<?php

include "Core/Includes/Autoloader.php";
\Core\Includes\Autoloader::register();

use App\src\Controllers\MainController;

$mainController = new MainController();
$mainController->control();