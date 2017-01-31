<?php

namespace App\Core\Contracts;


use App\Core\Models\Product;

interface ProductSystemContract
{
    public function present($request, $id = null, array $with = []);
    public function create($request);
    public function update($request, $id);
    public function delete($request, $id);
}