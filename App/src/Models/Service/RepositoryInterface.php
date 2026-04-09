<?php
namespace App\src\Models\Service;

interface RepositoryInterface {
    function save($entity);

    function find($id);
    function delete($id);
    function update($id, $entity);

    function all();
}