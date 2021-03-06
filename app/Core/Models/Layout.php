<?php

namespace App\Core\Models;

use Illuminate\Database\Eloquent\Model;
use App\Core\Traits\GeneratesUnique;
use RepositoryLab\Repository\Contracts\Transformable;
use RepositoryLab\Repository\Traits\TransformableTrait;

/**
 * App\Core\Models\Layout
 *
 * @mixin \Eloquent
 */
class Layout extends Model implements Transformable
{
    use TransformableTrait;
    use GeneratesUnique;

    protected $fillable = [];

    public static function boot()
    {
       parent::boot();
    }

}
