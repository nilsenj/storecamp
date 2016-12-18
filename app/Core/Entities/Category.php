<?php

namespace App\Core\Entities;

use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Category extends Model implements Transformable
{
    use TransformableTrait;

    use \Cviebrock\EloquentSluggable\Sluggable;
    use SluggableScopeHelpers;

    /**
     * @var array
     */
    protected $fillable = ['name', 'slug', 'description'];

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
    public function good()
    {
        return $this->hasMany(Good::class);
    }
    /**
     * @param $query
     * @return mixed
     */
    public function scopeOptions($query)
    {
        return $query->pluck('name', 'id');
    }


    public function parent()
    {
        return $this->belongsTo('App\Core\Entities\Category', 'parent_id');
    }

    public function children()
    {
        return $this->hasMany('App\Core\Entities\Category', 'parent_id');
    }
}
