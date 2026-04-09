<?php

namespace App\src\Views\Users;

use App\src\Models\Entities\Users\User;

class UserPresenter 
{
    public function present(?User $user): array
    {
        if (!$user) {
            return [];
        }

        return [
            'id' => $user->getId(),
            'nom' => htmlspecialchars($user->getNom()),
            'email' => htmlspecialchars($user->getEmail()),
            'adresse' => htmlspecialchars($user->getAdresse())
        ];
    }
}
