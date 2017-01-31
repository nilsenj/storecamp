<?php

namespace App\Core\Contracts;


use App\Core\Models\Product;

/**
 * Interface ProductSystemContract
 * @package App\Core\Contracts
 */
interface ProductSystemContract
{
    /**
     * @param $data
     * @param null $id
     * @param array $with
     * @return mixed
     */
    public function present($data, $id = null, array $with = []);

    /**
     * @param $data
     * @return mixed
     */
    public function create($data);

    /**
     * @param $data
     * @param $id
     * @return mixed
     */
    public function update($data, $id);

    /**
     * @param array $data
     * @param $id
     * @return mixed
     */
    public function delete($id, array $data = []) : int;
}