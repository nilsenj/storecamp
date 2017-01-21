<?php

namespace App\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Juggl\UniqueHashids\GeneratesUnique;
use RepositoryLab\Repository\Contracts\Transformable;
use RepositoryLab\Repository\Traits\TransformableTrait;

class Mail extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = "mails";
    protected $fillable = ["from", "to", "subject", "message", "user_id"];
    use GeneratesUnique;

    /**
     * bootable methods fix
     */
    public static function boot()
    {
        parent::boot();
    }
}
