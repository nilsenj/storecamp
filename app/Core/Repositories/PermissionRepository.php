<?php

namespace App\Core\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface PermissionRepository
 * @package namespace App\Core\Repositories;
 */
interface PermissionRepository extends RepositoryInterface
{
    public function renew($data, $permission);

}
