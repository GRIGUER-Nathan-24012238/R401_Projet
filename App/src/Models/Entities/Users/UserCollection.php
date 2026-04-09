<?php

namespace App\src\Models\Entities\Users;

use App\src\Models\Entities\Users\User;

/**
 * Class UserCollection
 * 
 * Collection of User entities.
 * 
 * @package App\src\Models\Entities\Users
 * @author  Hernandez Loic - Griguer Nathan
 */
class UserCollection
{
    /** @var User[] Internal storage for users */
    private array $users = [];

    /**
     * Adds a user to the collection.
     * 
     * @param User $user
     * @return void
     */
    public function add(User $user): void
    {
        $this->users[] = $user;
    }

    /**
     * Returns all users in the collection.
     * 
     * @return User[]
     */
    public function getAll(): array
    {
        return $this->users;
    }
}