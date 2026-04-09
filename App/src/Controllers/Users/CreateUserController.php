<?php

namespace App\src\Controllers\Users;

use App\src\Models\UseCase\Users\CreateUserUseCase;
use App\src\Models\Entities\Users\User;
use App\src\Views\Users\CreateUserView;
use Core\Controllers\ControllerInterface;

class CreateUserController implements ControllerInterface
{
    private CreateUserUseCase $createUserUseCase;
    private CreateUserView $createUserView;

    public function __construct(CreateUserUseCase $createUserUseCase, CreateUserView $createUserView)
    {
        $this->createUserUseCase = $createUserUseCase;
        $this->createUserView = $createUserView;
    }

    public function control(): void
    {
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $method = $_SERVER['REQUEST_METHOD'];

        if ($path === '/utilisateurs/nouveau') {
            if ($method === 'GET') {
                $this->createUserView->render();
            } elseif ($method === 'POST') {
                $nom = $_POST['nom'] ?? '';
                $email = $_POST['email'] ?? '';
                $adresse = $_POST['adresse'] ?? '';

                if ($nom && $email && $adresse) {
                    $user = new User($nom, $email, $adresse);
                    $this->createUserUseCase->execute($user);
                    header('Location: /utilisateurs');
                    exit();
                } else {
                    echo "Veuillez remplir tous les champs.";
                }
            }
        }
    }

    public static function support(string $path, string $method): bool
    {
        return $path === '/utilisateurs/nouveau';
    }
}
