<?php

namespace App\src\Models\Repository\API\Users\Factory;

use App\src\Models\Entities\Users\User;

class UsersFactory 
{
    public static function fromArray(array $data): User
    {
        return new User(
            $data['nom'] ?? '',
            $data['email'] ?? '',
            $data['adresse'] ?? '',
            isset($data['id']) ? (string)$data['id'] : null
        );
    }
}
