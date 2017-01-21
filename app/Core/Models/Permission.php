<?php


namespace App\Core\Models;

use App\Core\Access\AccessPermission;
use Juggl\UniqueHashids\GeneratesUnique;
use RepositoryLab\Repository\Contracts\Transformable;
use RepositoryLab\Repository\Traits\TransformableTrait;

class Permission extends AccessPermission implements Transformable
{
    use TransformableTrait;
    use GeneratesUnique;

    /**
     * bootable methods fix
     */
    public static function boot()
    {
        parent::boot();
    }
}
