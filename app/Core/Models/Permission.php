<?php


namespace App\Core\Models;

use App\Core\Access\AccessPermission;
use RepositoryLab\Repository\Contracts\Transformable;
use RepositoryLab\Repository\Traits\TransformableTrait;

class Permission extends AccessPermission implements Transformable
{
    use TransformableTrait;

}
