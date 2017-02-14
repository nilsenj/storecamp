<?php

namespace App\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Juggl\UniqueHashids\GeneratesUnique;
use RepositoryLab\Repository\Contracts\Transformable;
use RepositoryLab\Repository\Traits\TransformableTrait;

class Banner extends Model implements Transformable
{
    use TransformableTrait;
    use GeneratesUnique;

    protected $fillable = [];

    public static function boot()
    {
       parent::boot();
    }

}
