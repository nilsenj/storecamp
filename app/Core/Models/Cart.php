<?php

namespace App\Core\Models;

use Illuminate\Database\Eloquent\Model;
use RepositoryLab\Repository\Contracts\Transformable;
use RepositoryLab\Repository\Traits\TransformableTrait;

class Cart extends Model implements Transformable
{
    use TransformableTrait;
    protected $table = "cart";
    protected $casts = [
        'content' => 'json'
    ];
    protected $fillable = ['id', 'unique_id', 'instance', 'content'];

    public static function boot()
    {
       parent::boot();
    }
}
