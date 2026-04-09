<?php

namespace App\src\Models\Repository\API\Dishes;

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

    function save()
    {
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