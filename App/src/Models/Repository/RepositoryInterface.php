<?php

interface RepositoryInterface {
    function save();

    function find($id);
    function delete($id);
    function update($id);
}