<?php

namespace App\Core\Repositories;

use RepositoryLab\Repository\Contracts\RepositoryInterface;

/**
 * Interface ItemRepository
 * @package namespace FBA\Repositories;
 */
interface ItemRepository extends RepositoryInterface
{
    /**
     * @return mixed
     */
    public function getModel();

    /**
     * @param $basketId
     * @return mixed
     */
//    public function getItemWithBasketAttached($basketId);
}
