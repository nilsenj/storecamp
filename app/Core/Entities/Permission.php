<?php
/**
 * Copyright (c) 2016. Property of Combird. All Rights reserved 
 */

namespace App\Core\Entities;

use App\Core\Access\AccessPermission;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Permission extends AccessPermission implements Transformable
{
    use TransformableTrait;

}
