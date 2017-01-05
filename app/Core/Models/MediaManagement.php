<?php

namespace App\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Plank\Mediable\Media;
use RepositoryLab\Repository\Contracts\Transformable;
use RepositoryLab\Repository\Traits\TransformableTrait;

class MediaManagement extends Media implements Transformable
{
    use TransformableTrait;

//    protected $fillable = [];

}
