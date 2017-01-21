<?php

namespace App\Core\Models;

use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Model;
use Juggl\UniqueHashids\GeneratesUnique;
use RepositoryLab\Repository\Contracts\Transformable;
use RepositoryLab\Repository\Traits\TransformableTrait;

class Folder extends Model implements Transformable
{
    use TransformableTrait;
    use \Cviebrock\EloquentSluggable\Sluggable;
    use SluggableScopeHelpers;
    use GeneratesUnique;

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'order',
        'disk',
        'path_on_disk',
        'parent_id'
    ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }


    /**
     * bootable methods fix
     */
    public static function boot()
    {
        parent::boot();
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo('App\Core\Models\Folder', 'parent_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children()
    {
        return $this->hasMany('App\Core\Models\Folder', 'parent_id');
    }
}
