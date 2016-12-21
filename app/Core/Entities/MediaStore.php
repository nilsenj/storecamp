<?php

namespace App\Core\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class MediaStore extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [];

}
