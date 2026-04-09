<?php

namespace App\src\Models\UseCase\Users;

use App\src\Models\Service\RepositoryInterface;

/**
 * Class DeleteUserUseCase
 * 
 * Use case to delete a user (subscriber) from the system.
 * 
 * @package App\src\Models\UseCase\Users
 * @author  Hernandez Loic - Griguer Nathan
 */
class DeleteUserUseCase
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
     * Executes the use case to remove a user.
     * 
     * @param string $id The identifier of the user to delete
     * @return mixed The deletion result
     */
    public function execute(string $id)
    {
        return $this->repository->delete($id);
    }
}
