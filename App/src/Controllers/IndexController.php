<?php

namespace App\src\Controllers;

use Core\Controllers\ControllerInterface;
use App\src\Views\Index\IndexView;

/**
 * Class IndexController
 * 
 * Controller for the application's home page.
 * 
 * @package App\src\Controllers
 * @author  Hernandez Loic - Griguer Nathan
 */
class IndexController implements ControllerInterface {
    /**
     * Renders the home page view.
     * 
     * @return void
     */
    public function control(): void
    {
        $view= new IndexView();
        $view->render();
    }

    /**
     * Supports only the root GET request.
     * 
     * @param string $path
     * @param string $method
     * @return bool
     */
    public static function support(string $path, string $method): bool
    {
        return $path == '/' && $method === 'GET';
    }
}