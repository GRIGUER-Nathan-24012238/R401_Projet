<?php

namespace App\src\Controllers\Users;

use App\src\Models\UseCase\Users\GetUserUseCase;
use App\src\Models\UseCase\Users\DeleteUserUseCase;
use App\src\Views\Users\DeleteUserView;
use App\src\Views\Users\UserPresenter;
use Core\Controllers\ControllerInterface;

class DeleteUserController implements ControllerInterface
{
    private GetUserUseCase $getUserUseCase;
    private DeleteUserUseCase $deleteUserUseCase;
    private DeleteUserView $deleteUserView;
    private UserPresenter $userPresenter;

    public function __construct(
        GetUserUseCase $getUserUseCase, 
        DeleteUserUseCase $deleteUserUseCase, 
        DeleteUserView $deleteUserView, 
        UserPresenter $userPresenter
    ) {
        $this->getUserUseCase = $getUserUseCase;
        $this->deleteUserUseCase = $deleteUserUseCase;
        $this->deleteUserView = $deleteUserView;
        $this->userPresenter = $userPresenter;
    }

    public function control(): void
    {
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $method = $_SERVER['REQUEST_METHOD'];

        if (preg_match('#^/utilisateurs/([a-zA-Z0-9\-_]+)/supprimer$#', $path, $matches)) {
            $id = $matches[1];
            
            if ($method === 'GET') {
                $user = $this->getUserUseCase->execute($id);
                if ($user) {
                    $viewModel = $this->userPresenter->present($user);
                    $this->deleteUserView->setUserData($viewModel);
                    $this->deleteUserView->render();
                } else {
                    http_response_code(404);
                    echo "Abonné non trouvé.";
                }
            } elseif ($method === 'POST') {
                try {
                    $this->deleteUserUseCase->execute($id);
                    header('Location: /utilisateurs');
                    exit();
                } catch (\Exception $e) {
                    http_response_code(500);
                    echo "Erreur lors de la suppression : " . $e->getMessage();
                }
            }
        }
    }

    public static function support(string $path, string $method): bool
    {
        return preg_match('#^/utilisateurs/([a-zA-Z0-9\-_]+)/supprimer$#', $path);
    }
}
