<?php

namespace App\src\Controllers\Users;

use App\src\Views\Users\UsersView;
use App\src\Views\Users\UsersPresenter;
use Core\Controllers\ControllerInterface;

class GetAllUsersController implements ControllerInterface
{
    private UsersView $usersView;
    private UsersPresenter $usersPresenter;

    public function __construct(UsersView $usersView, UsersPresenter $usersPresenter)
    {
        $this->usersView = $usersView;
        $this->usersPresenter = $usersPresenter;
    }

    public function control(): void
    {
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        if ($path === '/utilisateurs' && $_SERVER['REQUEST_METHOD'] === 'GET') {
            $viewModel = $this->usersPresenter->present();
            $this->usersView->setUsers($viewModel);
            $this->usersView->render();
        }
    }

    public static function support(string $path, string $method): bool
    {
        return $method === 'GET' && $path === '/utilisateurs';
    }
}
