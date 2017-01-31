<?php

namespace App\Core\Contracts;


interface CategorySystemContract
{
    public function present(array $data, $id = null, array $with = []);
    public function create(array $data);
    public function update(array $data, $id);
    public function delete($id, array $data = []) : int;
}