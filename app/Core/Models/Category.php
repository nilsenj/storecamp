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
        'image_link',
        'parent_id',
        'status',
        'top',
        'sort_order',
        'meta_tag_title',
        'meta_tag_description',
        'meta_tag_keywords'
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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products() {
        return $this->belongsToMany('Product', 'products_categories');
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
