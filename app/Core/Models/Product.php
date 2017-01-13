<?php

namespace App\Core\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use RepositoryLab\Repository\Contracts\Transformable;
use RepositoryLab\Repository\Traits\TransformableTrait;

class Product extends Model implements Transformable
{
    use TransformableTrait;
    use \Cviebrock\EloquentSluggable\Sluggable;


    /**
     * @var array
     */
    protected $fillable = [
        'slug',
        'model',
        'title',
        'body',
        'price',
        'availability',
        'date_available',
        'model',
        'quantity',
        'viewed',
        'sku',
        'upc',
        'ean',
        'jan',
        'isbn',
        'mpn',
//        'length',
//        'width',
//        'height',
//        'weight',
        'meta_tag_title',
        'meta_tag_description',
        'meta_tag_keywords',
//        'sort_order',
        'stock_status',
        'attr_description_id',
        'product_id',
        'value'
    ];

    protected $dates = ['date_available'];

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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories() {

        return $this->belongsToMany(Category::class, 'products_categories');

    }

    public function attributeGroupDescription()
    {
        return $this->belongsToMany(AttributeGroupDescription::class, "product_attribute", "product_id", "attr_description_id")->withPivot("value");
    }

    /**
     * @return mixed
     */
    public function getFirstCategory() {
        return $this->categories()->first();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function comments()
    {
        return $this->morphMany('Comment', 'commentable');
    }

    /**
     * @param $date
     */
    public function setDateAvailable($date) {
        if(!$date) {
            $this->attributes['date_available'] = Carbon::now();
        } else {
            $this->attributes['date_available'] = Carbon::createFromFormat("yyyy-mm-dd h:m", $date);
        }
    }

    /**
     * @param $query
     */
    public function scopeUnpublished($query) {
        $query->where('date_available', '>', Carbon::now());
    }

    /**
     * @param $query
     */
    public function scopePublished($query) {
        $query->where('date_available', '<=', Carbon::now());
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeNewest($query)
    {
        return $query->orderBy('created_at', 'desc');
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
     * @param $query
     * @param Category|null $category
     * @return mixed
     */
    public function scopeCategorized($query, Category $category=null) {
        if ( is_null($category) ) return $query->with('categories');

        $categoryIds = $category->children()->pluck('id');
        array_unshift($categoryIds, $category->id);

        return $query->with('categories')
            ->join('products_categories', 'products_categories.product_id', '=', 'products.id')
            ->whereIn('products_categories.category_id', $categoryIds);
    }


}
