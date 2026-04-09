<?php

namespace App\src\Models\UseCase\Users;

use App\src\Models\Entities\Users\User;
use App\src\Models\Service\RepositoryInterface;

/**
 * Class UpdateUserUseCase
 * 
 * Use case to update an existing user's information.
 * 
 * @package App\src\Models\UseCase\Users
 * @author  Hernandez Loic - Griguer Nathan
 */
class UpdateUserUseCase
{
    /** @var RepositoryInterface The repository for user data */
    private RepositoryInterface $repository;

    /**
     * @param RepositoryInterface $repository
     */
    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Executes the use case to update a user.
     * 
     * @param string $id The current identifier of the user
     * @param User $user The new user data
     * @return mixed The update result
     */
    public function execute(string $id, User $user)
    {
        return $this->repository->update($id, $user);
    }
}
