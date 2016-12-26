<?php

namespace App\Core\Repositories;

use RepositoryLab\Repository\Contracts\RepositoryInterface;

/**
 * Interface BasketRepository
 * @package namespace FBA\Repositories;
 */
interface BasketRepository extends RepositoryInterface
{
    public function getModel();
}
