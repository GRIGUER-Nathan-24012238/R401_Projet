<?php

namespace App\src\Models\UseCase\Dishes;

use App\src\Models\Service\RepositoryInterface;

/**
 * Class DeleteDishUseCase
 * 
 * Use case to delete a dish from the catalogue.
 * 
 * @package App\src\Models\UseCase\Dishes
 * @author  Hernandez Loic - Griguer Nathan
 */
class DeleteDishUseCase
{
    /** @var RepositoryInterface The repository for dish data */
    private RepositoryInterface $repository;

    /**
     * @param RepositoryInterface $repository
     */
    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Executes the use case to remove a dish.
     * 
     * @param string $id The identifier of the dish to delete
     * @return void
     */
    public function execute(string $id): void
    {
        $this->repository->delete($id);
    }
}