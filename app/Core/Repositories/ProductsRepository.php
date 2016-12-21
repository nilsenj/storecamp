<?php

namespace App\Core\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface ProductsRepository
 * @package namespace App\Core\Repositories;
 */
interface ProductsRepository extends RepositoryInterface
{
    public function getProduct();
    public function getModel();

}
