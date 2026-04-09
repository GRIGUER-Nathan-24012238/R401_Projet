<?php

namespace App\src\Models\Repository\API\Dishes;

use App\src\Models\Service\RepositoryInterface;

class APIDishesRepository implements RepositoryInterface
{
    function save()
    {
        $response = file_get_contents('http://localhost:8000');
    }

    function find($id)
    {}
    function delete($id)
    {}
    function update($id)
    {}

    function all()
    {
        $file = file_get_contents('http://localhost:3001/plats');
        print_r($file);
        return json_decode($file, true);
    }
}