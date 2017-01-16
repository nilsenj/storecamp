<?php

namespace App\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Juggl\UniqueHashids\GeneratesUnique;
use RepositoryLab\Repository\Contracts\Transformable;
use RepositoryLab\Repository\Traits\TransformableTrait;

class NewsLetterList extends Model implements Transformable
{
    use TransformableTrait;

    use SoftDeletes;
    use GeneratesUnique;

    protected $table = "subscriber_list";

    protected $fillable = [
        'listName',
        'product_id',
        'unique_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function subscribers()
    {
        return $this->belongsToMany(Subscribers::class, "news_list", 'subscriber_list_id', 'subscriber_id')->withTimestamps();
    }

    /**
     * get the list where product_id exists
     *
     * @param $query
     * @param $product_id
     */
    public function scopeProducts($query, $product_id){

        $query->where("product_id", $product_id);
    }

}
