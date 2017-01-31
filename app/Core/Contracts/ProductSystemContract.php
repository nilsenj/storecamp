<?php

namespace App\Core\Contracts;


use App\Core\Models\Product;

interface ProductSystemContract
{
    public function present($data, $id = null, array $with = []);
    public function create($data);
    public function update($data, $id);
    public function delete($data = [], $id);
}