<?php

namespace App\Core\Repositories;

use RepositoryLab\Repository\Contracts\RepositoryInterface;

/**
 * Interface MediaRepository
 * @package namespace App\Core\Repositories;
 */
interface MediaRepository extends RepositoryInterface
{
    public function transform($request, $folder = null, $tag = null, $disk = '', bool $skipPaginate = false);
    public function inDirectory($disk, $directory, $tag = null, $recursive = false);
}
