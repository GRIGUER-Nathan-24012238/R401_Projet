<?php

namespace App\src\Models\Repository\API\Dishes;

use App\src\Models\Entities\Dishes\Dish;
use App\src\Models\Entities\Dishes\DishCollection;
use App\src\Models\Repository\API\Dishes\Factory\DishesFactory;
use App\src\Models\Service\RepositoryInterface;
class APIDishesRepository implements RepositoryInterface
{

    private string $baseUrl;

    public function __construct(string $baseUrl) 
    {
        $this->baseUrl = $baseUrl;
    }

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
        $result = file_get_contents($this->baseUrl . '/plats', false, $context);

        if ($result === false) {
            throw new \RuntimeException('Erreur lors de la sauvegarde du plat via l\'API.');
        }

        $http_response_header = $http_response_header ?? [];
        if (!preg_match('/20[0-1]/', $http_response_header[0])) {
            throw new \RuntimeException('L\'API a retourné une erreur: ' . $http_response_header[0] . ' - ' . $result);
        }

        return json_decode($result, true);
    }

    function find($id)
    {}
    function delete($id)
    {}
    function update($id)
    {}

    public function all()
    {
        $response = file_get_contents($this->baseUrl . '/plats');

        if ($response === false) {
            throw new \RuntimeException('Impossible de contacter l\'API plats.');
        }

        $data = json_decode($response, true);

        return $data;
    }
}