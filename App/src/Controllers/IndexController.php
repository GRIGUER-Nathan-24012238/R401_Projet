<?php

namespace App\src\Controllers;

use Core\Controllers\ControllerInterface;
use App\src\Views\Index\IndexView;

class IndexController implements ControllerInterface {
    public function control(): void
    {
        $view= new IndexView();
        $view->render();
    }

    public static function support(string $path, string $method): bool
    {
        return $path == '/' && $method === 'GET';
    }
}