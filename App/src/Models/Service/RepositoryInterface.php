<?php
namespace App\src\Models\Service;

interface RepositoryInterface {
    function save();

    function find($id);
    function delete($id);
    function update($id);

    function all();
}