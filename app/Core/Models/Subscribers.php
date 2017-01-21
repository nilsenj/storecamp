<?php

namespace App\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Juggl\UniqueHashids\GeneratesUnique;
use RepositoryLab\Repository\Contracts\Transformable;
use RepositoryLab\Repository\Traits\TransformableTrait;

/**
 * Class Subscribers
 * @package App\Core\Models
 */
class Subscribers extends Model implements Transformable
{
    use TransformableTrait, SoftDeletes;
    use GeneratesUnique;

    /**
     * @var string
     */
    protected $table = "subscribers";

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'unique_id'
    ];

    /**
     * bootable methods fix
     */
    public static function boot()
    {
        parent::boot();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function campaign()
    {
        return $this->belongsToMany(Campaign::class, "campaign_subscribers", 'subscriber_id', 'campaign_id')->withTimestamps();
    }

    /**
     * @param $query
     * @param $mail
     */
    public function scopeMails($query, $mail) {

        $query->where("email", $mail);
    }
    
}
