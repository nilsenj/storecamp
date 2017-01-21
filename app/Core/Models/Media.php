<?php

namespace App\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Juggl\UniqueHashids\GeneratesUnique;
use RepositoryLab\Repository\Contracts\Transformable;
use RepositoryLab\Repository\Traits\TransformableTrait;

class Media extends \Plank\Mediable\Media implements Transformable
{
    use TransformableTrait;

    protected $fillable = ['directory_id'];
    protected $guarded = ['id', 'disk', 'directory', 'directory_id', 'filename', 'extension', 'size', 'mime_type', 'aggregate_type'];


    /**
     * bootable methods fix
     */
    public static function boot()
    {
        parent::boot();
    }
}
