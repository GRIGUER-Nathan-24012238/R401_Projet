<?php

namespace App\src\Models\Repository\API\Users;

use App\src\Models\Entities\Users\User;
use App\src\Models\Entities\Users\UserCollection;
use App\src\Models\Repository\API\Users\Factory\UsersFactory;
use App\src\Models\Service\RepositoryInterface;

class APIUsersRepository implements RepositoryInterface
{
    private string $baseUrl;

    public function __construct(string $baseUrl) 
    {
        $this->baseUrl = $baseUrl;
    }

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
            throw new \RuntimeException('Erreur de connexion à l\'API (/utilisateurs) : ' . ($error['message'] ?? 'Serveur injoignable.'));
        }

        return json_decode($result, true);
    }

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
            throw new \RuntimeException('Erreur de connexion à l\'API pour la suppression de l\'utilisateur : ' . ($error['message'] ?? 'Serveur injoignable.'));
        }

        return true;
    }

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
            throw new \RuntimeException('Erreur de connexion à l\'API pour la mise à jour de l\'utilisateur : ' . ($error['message'] ?? 'Serveur injoignable.'));
        }

        return json_decode($result, true);
    }

    public function all()
    {
        $response = @file_get_contents($this->baseUrl . '/utilisateurs');

        if ($response === false) {
            throw new \RuntimeException('Impossible de contacter l\'API utilisateurs.');
        }

        $data = json_decode($response, true);
        $collection = new UserCollection();

        foreach ($data as $userData) {
            $collection->add(UsersFactory::fromArray($userData));
        }

        return $collection;
    }
}
