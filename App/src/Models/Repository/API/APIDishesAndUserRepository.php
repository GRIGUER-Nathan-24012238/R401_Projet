<?php

namespace App\src\Models\Repository\API;

use App\src\Models\Service\RepositoryInterface;

class APIDishesAndUserRepository implements RepositoryInterface
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
    {}
}