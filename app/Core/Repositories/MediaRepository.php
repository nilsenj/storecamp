<?php

namespace App\Core\Repositories;

use RepositoryLab\Repository\Contracts\RepositoryInterface;

/**
 * Interface MediaRepository
 * @package namespace App\Core\Repositories;
 */
interface MediaRepository extends RepositoryInterface
{
    public function getModel();
    public function allOrSearch($searchQuery = null);
    public function transform($request, $path = null, $tag = null);
}
