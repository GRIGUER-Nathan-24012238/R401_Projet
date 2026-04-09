<?php

namespace App\src\Models\UseCase\Users;

use App\src\Models\Service\RepositoryInterface;

/**
 * Class GetUsersUseCase
 * 
 * Use case to retrieve all users (subscribers).
 * 
 * @package App\src\Models\UseCase\Users
 * @author  Hernandez Loic - Griguer Nathan
 */
class GetUsersUseCase
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
     * Executes the use case to list all users.
     * 
     * @return mixed A collection of users (Repository return)
     */
    public function execute()
    {
        return $this->repository->all();
    }
}
