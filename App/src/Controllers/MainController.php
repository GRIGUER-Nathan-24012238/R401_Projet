<?php

namespace App\src\Controllers;

use Core\Controllers\ControllerInterface;
use App\src\Views\MainView;

class MainController implements ControllerInterface {
    public function control(): void
    {
        $view= new MainView();
        $view->render();
    }

    public static function support(string $path, string $method): bool
    {
        return $path == '/' && $method === 'GET';
    }
}