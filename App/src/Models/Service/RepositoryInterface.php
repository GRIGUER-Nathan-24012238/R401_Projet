<?php
namespace App\src\Models\Service;

/**
 * Interface RepositoryInterface
 * 
 * Defines the generic contract for a repository handling domain entities.
 * 
 * @package App\src\Models\Service
 * @author  Hernandez Loic - Griguer Nathan
 */
interface RepositoryInterface {
    /**
     * Persists a new entity.
     * 
     * @param mixed $entity The entity to save
     * @return mixed The save result
     */
    function save($entity);

    /**
     * Retrieves an entity by its identifier.
     * 
     * @param string $id The unique identifier
     * @return mixed|null The entity if found, null otherwise
     */
    function find($id);

    /**
     * Removes an entity by its identifier.
     * 
     * @param string $id The unique identifier
     * @return bool True on success
     */
    function delete($id);

    /**
     * Updates an existing entity.
     * 
     * @param string $id The identifier of the entity to update
     * @param mixed $entity The new entity data
     * @return mixed The update result
     */
    function update($id, $entity);

    /**
     * Retrieves all entities.
     * 
     * @return array|object A collection of all entities
     */
    function all();
}