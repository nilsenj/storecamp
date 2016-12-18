<?php

namespace App\Core\Entities;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Good extends Model implements Transformable
{
    use TransformableTrait;
    use \Cviebrock\EloquentSluggable\Sluggable;


    /**
     * @var array
     */
    protected $fillable = [
        'type',
        'user_id',
        'title',
        'body',
        'price',
        'availability',
        'published_at',
        'slug',
        'count',
        'category_id'

    ];

    protected $dates = ['published_at'];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function comments()
    {
        return $this->morphMany('Comment', 'commentable');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function picture()
    {

        return $this->belongsToMany(Picture::class);

    }

    /**
     * @param $date
     */
    public function setPublishedAtAttribute ($date) {
        $this->attributes['published_at'] = Carbon::createFromFormat('Y-m-d', $date);
    }

    public function scopeUnpublished($query) {
        $query->where('published_at', '>', Carbon::now());
    }

    public function scopePublished($query) {
        $query->where('published_at', '<=', Carbon::now());
    }

    public function scopeNewest($query)
    {
        return $query->orderBy('created_at', 'desc');
    }
    /**
     * @param $query
     * @return mixed
     */
    public function scopeOnlyPage($query)
    {
        return $query->whereType('page');
    }
    /**
     * @param $query
     * @return mixed
     */
    public function scopeOnlyGood($query)
    {
        return $query->whereType('good');
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeDrafted($query)
    {
        return $query->where('published_at', '!=' , null);
    }
    /**
     * @param $query
     * @param $id
     * @return mixed
     */
    public function scopeBySlugOrId($query, $id)
    {
        return $query->where($id)->orWhere('slug', '=', $id);
    }


    /**
     * @param $file
     * @return bool
     */
    public static function deleteImage($file)
    {
        $filepath = self::image_path($file);

        if (file_exists($filepath)) {

            \File::delete($filepath);
            return true;
        }
        return false;
    }

    public static function image_path($file)
    {
        return public_path("images/goods/{$file}");
    }

}
