<?php

namespace App\Core\Models;

use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Model;
use RepositoryLab\Repository\Contracts\Transformable;
use RepositoryLab\Repository\Traits\TransformableTrait;

class Category extends Model implements Transformable
{
    use TransformableTrait;

    use \Cviebrock\EloquentSluggable\Sluggable;
    use SluggableScopeHelpers;

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
        'status',
        'top',
        'column',
        'sort_order'
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
    public function product()
    {
        return $this->hasMany(Product::class);
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
        return $this->belongsTo('App\Core\Models\Category', 'parent_id');
    }

    public function children()
    {
        return $this->hasMany('App\Core\Models\Category', 'parent_id');
    }
}
