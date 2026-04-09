<?php

namespace App\src\Models\Repository\API\Users\Factory;

use App\src\Models\Entities\Users\User;

/**
 * Class UsersFactory
 * 
 * Factory for creating User entities from raw data arrays.
 * 
 * @package App\src\Models\Repository\API\Users\Factory
 * @author  Hernandez Loic - Griguer Nathan
 */
class UsersFactory 
{
    /**
     * Creates a User entity from an associative array.
     * 
     * @param array $data Raw user data from the API
     * @return User
     */
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
