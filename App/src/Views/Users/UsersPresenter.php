<?php

namespace App\src\Views\Users;

use App\src\Models\UseCase\Users\GetUsersUseCase;

class UsersPresenter 
{
    private GetUsersUseCase $getUsersUseCase;

    public function __construct(GetUsersUseCase $getUsersUseCase) 
    {
        $this->getUsersUseCase = $getUsersUseCase;
    }

    public function present(): array 
    {
        $userCollection = $this->getUsersUseCase->execute();
        $users = $userCollection->getAll();
        $viewModel = [];

        foreach ($users as $user) {
            $viewModel[] = [
                'id' => $user->getId(),
                'nom' => htmlspecialchars($user->getNom()),
                'email' => htmlspecialchars($user->getEmail()),
                'adresse' => htmlspecialchars($user->getAdresse())
            ];
        }

        return $viewModel;
    }
}
