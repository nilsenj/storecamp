<?php

namespace App\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Juggl\UniqueHashids\GeneratesUnique;
use RepositoryLab\Repository\Contracts\Transformable;
use RepositoryLab\Repository\Traits\TransformableTrait;

class Campaign extends Model implements Transformable
{
    use TransformableTrait;
    use SoftDeletes;
    use GeneratesUnique;

    protected $table = "campaigns";

    protected $fillable = [
        'campaign',
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
    public function subscribers()
    {
        return $this->belongsToMany(Subscribers::class, "campaign_subscribers", 'campaign_id', 'subscriber_id')->withTimestamps();
    }
}
