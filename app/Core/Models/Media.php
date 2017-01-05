<?php

namespace App\Core\Models;

use Illuminate\Database\Eloquent\Model;
use RepositoryLab\Repository\Contracts\Transformable;
use RepositoryLab\Repository\Traits\TransformableTrait;

class Media extends \Plank\Mediable\Media implements Transformable
{
    use TransformableTrait;

//    protected $fillable = [];

}
