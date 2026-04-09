<?php

namespace App\src\Models\Repository\API\Dishes;

use App\src\Models\Entities\Dishes\Dish;
use App\src\Models\Entities\Dishes\DishCollection;
use App\src\Models\Repository\API\Dishes\Factory\DishesFactory;
use App\src\Models\Service\RepositoryInterface;
/**
 * Class APIDishesRepository
 * 
 * API-based implementation of the Dish repository.
 * 
 * Handles communication with the remote JSON-server for Dish entities.
 * 
 * @package App\src\Models\Repository\API\Dishes
 * @author  Hernandez Loic - Griguer Nathan
 */
class APIDishesRepository implements RepositoryInterface
{
    /** @var string The base URL of the API */
    private string $baseUrl;

    /**
     * @param string $baseUrl
     */
    public function __construct(string $baseUrl) 
    {
        $this->baseUrl = $baseUrl;
    }

    /**
     * Persists a new dish to the API.
     * 
     * @param Dish $entity
     * @return array The created dish data
     * @throws \RuntimeException if the API is unreachable or returns an error
     */
    function save($entity)
    {
        if (!$entity instanceof Dish) {
            throw new \InvalidArgumentException('Entity must be an instance of Dish');
        }

        $data = [
            'nom' => $entity->getName(),
            'description' => $entity->getDescription(),
            'prix' => $entity->getPrix()
        ];

        $options = [
            'http' => [
                'header'  => "Content-type: application/json\r\n",
                'method'  => 'POST',
                'content' => json_encode($data),
                'ignore_errors' => true
            ]
        ];

        $context  = stream_context_create($options);
        $result = @file_get_contents($this->baseUrl . '/plats', false, $context);

        if ($result === false) {
            $error = error_get_last();
            throw new \RuntimeException('API connection error (' . $this->baseUrl . ') : ' . ($error['message'] ?? 'Server unreachable.'));
        }

        $http_status = $http_response_header[0] ?? 'Unknown';
        if (!preg_match('/20[0-1]/', $http_status)) {
            throw new \RuntimeException('API returned an error (' . $http_status . ') : ' . $result);
        }

        return json_decode($result, true);
    }

    /**
     * Finds a dish by its unique identifier.
     * 
     * @param string|int $id
     * @return Dish|null
     */
    function find($id)
    {
        $response = @file_get_contents($this->baseUrl . '/plats/' . $id);

        if ($response === false) {
            return null;
        }

        $data = json_decode($response, true);
        if (!$data) {
            return null;
        }

        return DishesFactory::fromArray($data);
    }

    /**
     * Updates an existing dish via the API.
     * 
     * @param string|int $id
     * @param Dish $entity
     * @return array The updated dish data
     */
    function update($id, $entity)
    {
        if (!$entity instanceof Dish) {
            throw new \InvalidArgumentException('Entity must be an instance of Dish');
        }

        $data = [
            'nom' => $entity->getName(),
            'description' => $entity->getDescription(),
            'prix' => $entity->getPrix()
        ];

        $options = [
            'http' => [
                'header'  => "Content-type: application/json\r\n",
                'method'  => 'PUT',
                'content' => json_encode($data),
                'ignore_errors' => true
            ]
        ];

        $context  = stream_context_create($options);
        $result = @file_get_contents($this->baseUrl . '/plats/' . $id, false, $context);

        if ($result === false) {
            $error = error_get_last();
            throw new \RuntimeException('API connection error during update: ' . ($error['message'] ?? 'Server unreachable.'));
        }

        return json_decode($result, true);
    }
    /**
     * Deletes a dish from the API.
     * 
     * @param string|int $id
     * @return bool
     */
    function delete($id)
    {
        $options = [
            'http' => [
                'method' => 'DELETE',
                'ignore_errors' => true
            ]
        ];

        $context = stream_context_create($options);
        $result = @file_get_contents($this->baseUrl . '/plats/' . $id, false, $context);

        if ($result === false) {
            $error = error_get_last();
            throw new \RuntimeException('API connection error during deletion: ' . ($error['message'] ?? 'Server unreachable.'));
        }

        return true;
    }

    /**
     * Fetches raw list of all dishes from the API.
     * 
     * @return array Raw dishes data
     */
    public function all()
    {
        $response = file_get_contents($this->baseUrl . '/plats');

        if ($response === false) {
            throw new \RuntimeException('Unable to reach the dishes API.');
        }

        $data = json_decode($response, true);

        return $data;
    }
}