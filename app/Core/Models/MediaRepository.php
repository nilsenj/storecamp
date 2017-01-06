<?php

namespace App\Core\Models;

use Illuminate\Database\Eloquent\Model;
use RepositoryLab\Repository\Contracts\Transformable;
use RepositoryLab\Repository\Traits\TransformableTrait;

class MediaRepository extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [];

}