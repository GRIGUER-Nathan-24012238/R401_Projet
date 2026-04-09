<?php

namespace App\src\Controllers\Users;

use App\src\Models\UseCase\Users\GetUserUseCase;
use App\src\Views\Users\GetUserView;
use App\src\Views\Users\UserPresenter;
use Core\Controllers\ControllerInterface;

class GetUserController implements ControllerInterface
{
    private GetUserUseCase $getUserUseCase;
    private GetUserView $getUserView;
    private UserPresenter $userPresenter;

    public function __construct(GetUserUseCase $getUserUseCase, GetUserView $getUserView, UserPresenter $userPresenter)
    {
        $this->getUserUseCase = $getUserUseCase;
        $this->getUserView = $getUserView;
        $this->userPresenter = $userPresenter;
    }

    public function control(): void
    {
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        if (preg_match('#^/utilisateurs/([a-zA-Z0-9\-_]+)$#', $path, $matches)) {
            $id = $matches[1];
            $user = $this->getUserUseCase->execute($id);
            
            if ($user) {
                $viewModel = $this->userPresenter->present($user);
                $this->getUserView->setUserData($viewModel);
                $this->getUserView->render();
            } else {
                http_response_code(404);
                echo "Abonné non trouvé.";
            }
        }
    }

    public static function support(string $path, string $method): bool
    {
        return $method === 'GET' && preg_match('#^/utilisateurs/([a-zA-Z0-9\-_]+)$#', $path);
    }
}
