<?php

namespace App\src\Models\UseCase\Users;

use App\src\Models\Entities\Users\User;
use App\src\Models\Service\RepositoryInterface;

/**
 * Class GetUserUseCase
 * 
 * Use case to retrieve a single user (subscriber) by its identifier.
 * 
 * @package App\src\Models\UseCase\Users
 * @author  Hernandez Loic - Griguer Nathan
 */
class GetUserUseCase
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
     * Executes the use case to find a user.
     * 
     * @param string $id The unique identifier of the user
     * @return User|null The found user or null if not found
     */
    public function execute(string $id): ?User
    {
        return $this->repository->find($id);
    }
}
