<?php

namespace App\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Juggl\UniqueHashids\GeneratesUnique;
use RepositoryLab\Repository\Contracts\Transformable;
use RepositoryLab\Repository\Traits\TransformableTrait;

class Subscribers extends Model implements Transformable
{
    use TransformableTrait, SoftDeletes;
    use GeneratesUnique;

    /**
     * @var string
     */
    protected $table = "subscribers";

    protected $fillable = [
        'name',
        'email',
        'unique_id'
    ];

    public function newsList()
    {
        return $this->belongsToMany(NewsLetterList::class, "news_list", 'subscriber_id', 'subscriber_list_id')->withTimestamps();
    }

    public function scopeMails($query, $mail) {

        $query->where("email", $mail);
    }
    
}
