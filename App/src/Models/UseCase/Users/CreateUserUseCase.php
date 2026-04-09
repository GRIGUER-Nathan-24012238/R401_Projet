<?php

namespace App\src\Models\UseCase\Users;

use App\src\Models\Entities\Users\User;
use App\src\Models\Service\RepositoryInterface;

/**
 * Class CreateUserUseCase
 * 
 * Use case to create a new user (subscriber) in the system.
 * 
 * @package App\src\Models\UseCase\Users
 * @author  Hernandez Loic - Griguer Nathan
 */
class CreateUserUseCase
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
     * Executes the use case to save a new user.
     * 
     * @param User $user The user entity to persist
     * @return mixed The creation result
     */
    public function execute(User $user)
    {
        return $this->repository->save($user);
    }
}
