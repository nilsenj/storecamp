<?php

namespace App\Core\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface GoodsRepository
 * @package namespace App\Core\Repositories;
 */
interface GoodsRepository extends RepositoryInterface
{
    public function getGood();
    public function getModel();

}
