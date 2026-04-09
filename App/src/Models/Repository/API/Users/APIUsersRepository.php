<?php

namespace App\src\Models\Repository\API\Users;

use App\src\Models\Entities\Users\User;
use App\src\Models\Entities\Users\UserCollection;
use App\src\Models\Repository\API\Users\Factory\UsersFactory;
use App\src\Models\Service\RepositoryInterface;

/**
 * Class APIUsersRepository
 * 
 * API-based implementation of the User repository.
 * 
 * Handles communication with the remote JSON-server for User (subscriber) entities.
 * 
 * @package App\src\Models\Repository\API\Users
 * @author  Hernandez Loic - Griguer Nathan
 */
class APIUsersRepository implements RepositoryInterface
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
     * Persists a new user to the API.
     * 
     * @param User $entity
     * @return array The created user data
     * @throws \RuntimeException if the API is unreachable
     */
    public function save($entity)
    {
        if (!$entity instanceof User) {
            throw new \InvalidArgumentException('Entity must be an instance of User');
        }

        $data = [
            'nom' => $entity->getNom(),
            'email' => $entity->getEmail(),
            'adresse' => $entity->getAdresse()
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
        $result = @file_get_contents($this->baseUrl . '/utilisateurs', false, $context);

        if ($result === false) {
            $error = error_get_last();
            throw new \RuntimeException('API connection error (/utilisateurs) : ' . ($error['message'] ?? 'Server unreachable.'));
        }

        return json_decode($result, true);
    }

    /**
     * Finds a user by its unique identifier.
     * 
     * @param string|int $id
     * @return User|null
     */
    public function find($id)
    {
        $response = @file_get_contents($this->baseUrl . '/utilisateurs/' . $id);

        if ($response === false) {
            return null;
        }

        $data = json_decode($response, true);
        if (!$data) {
            return null;
        }

        return UsersFactory::fromArray($data);
    }

    /**
     * Deletes a user from the API.
     * 
     * @param string|int $id
     * @return bool
     */
    public function delete($id)
    {
        $options = [
            'http' => [
                'method' => 'DELETE',
                'ignore_errors' => true
            ]
        ];

        $context = stream_context_create($options);
        $result = @file_get_contents($this->baseUrl . '/utilisateurs/' . $id, false, $context);

        if ($result === false) {
            $error = error_get_last();
            throw new \RuntimeException('API connection error during deletion: ' . ($error['message'] ?? 'Server unreachable.'));
        }

        return true;
    }

    /**
     * Updates an existing user via the API.
     * 
     * @param string|int $id
     * @param User $entity
     * @return array The updated user data
     */
    public function update($id, $entity)
    {
        if (!$entity instanceof User) {
            throw new \InvalidArgumentException('Entity must be an instance of User');
        }

        $data = [
            'nom' => $entity->getNom(),
            'email' => $entity->getEmail(),
            'adresse' => $entity->getAdresse()
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
        $result = @file_get_contents($this->baseUrl . '/utilisateurs/' . $id, false, $context);

        if ($result === false) {
            $error = error_get_last();
            throw new \RuntimeException('API connection error during update: ' . ($error['message'] ?? 'Server unreachable.'));
        }

        return json_decode($result, true);
    }

    /**
     * Fetches raw list of all users from the API and maps them to a collection.
     * 
     * @return UserCollection
     */
    public function all()
    {
        $response = @file_get_contents($this->baseUrl . '/utilisateurs');

        if ($response === false) {
            throw new \RuntimeException('Unable to reach the users API.');
        }

        $data = json_decode($response, true);
        $collection = new UserCollection();

        foreach ($data as $userData) {
            $collection->add(UsersFactory::fromArray($userData));
        }

        return $collection;
    }
}
