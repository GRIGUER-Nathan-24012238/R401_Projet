<?php

namespace App\src\Controllers\Users;

use App\src\Models\UseCase\Users\GetUserUseCase;
use App\src\Models\UseCase\Users\UpdateUserUseCase;
use App\src\Models\Entities\Users\User;
use App\src\Views\Users\UpdateUserView;
use App\src\Views\Users\UserPresenter;
use Core\Controllers\ControllerInterface;

class UpdateUserController implements ControllerInterface
{
    private GetUserUseCase $getUserUseCase;
    private UpdateUserUseCase $updateUserUseCase;
    private UpdateUserView $updateUserView;
    private UserPresenter $userPresenter;

    public function __construct(
        GetUserUseCase $getUserUseCase, 
        UpdateUserUseCase $updateUserUseCase, 
        UpdateUserView $updateUserView, 
        UserPresenter $userPresenter
    ) {
        $this->getUserUseCase = $getUserUseCase;
        $this->updateUserUseCase = $updateUserUseCase;
        $this->updateUserView = $updateUserView;
        $this->userPresenter = $userPresenter;
    }

    public function control(): void
    {
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $method = $_SERVER['REQUEST_METHOD'];
        
        if (preg_match('#^/utilisateurs/([a-zA-Z0-9\-_]+)/modifier$#', $path, $matches)) {
            $id = $matches[1];

            if ($method === 'GET') {
                $user = $this->getUserUseCase->execute($id);
                if ($user) {
                    $viewModel = $this->userPresenter->present($user);
                    $this->updateUserView->setUserData($viewModel);
                    $this->updateUserView->render();
                } else {
                    http_response_code(404);
                    echo "Abonné non trouvé.";
                }
            } elseif ($method === 'POST') {
                $nom = $_POST['nom'] ?? '';
                $email = $_POST['email'] ?? '';
                $adresse = $_POST['adresse'] ?? '';

                if ($nom && $email && $adresse) {
                    $user = new User($nom, $email, $adresse);
                    $this->updateUserUseCase->execute($id, $user);
                    header('Location: /utilisateurs/' . $id);
                    exit();
                } else {
                    echo "Veuillez remplir tous les champs.";
                }
            }
        }
    }

    public static function support(string $path, string $method): bool
    {
        return preg_match('#^/utilisateurs/([a-zA-Z0-9\-_]+)/modifier$#', $path);
    }
}
