<?php

namespace App\Core\Models;

use App\Core\Components\Auditing\Auditable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Juggl\UniqueHashids\GeneratesUnique;
use RepositoryLab\Repository\Contracts\Transformable;
use RepositoryLab\Repository\Traits\TransformableTrait;

/**
 * App\Core\Models\Product
 *
 * @property int $id
 * @property string $unique_id
 * @property string $title
 * @property string $body
 * @property string $model
 * @property string $slug
 * @property string $stock_status
 * @property int $viewed
 * @property int $quantity
 * @property string $sku
 * @property string $upc
 * @property string $ean
 * @property string $jan
 * @property string $isbn
 * @property string $mpn
 * @property float $price
 * @property float $length
 * @property float $width
 * @property float $height
 * @property float $weight
 * @property \Carbon\Carbon $date_available
 * @property bool $availability
 * @property string $meta_tag_title
 * @property string $meta_tag_description
 * @property string $meta_tag_keywords
 * @property bool $sort_order
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Core\Models\User $user
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Core\Models\ProductReview[] $productReview
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Core\Models\Category[] $categories
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Core\Models\AttributeGroupDescription[] $attributeGroupDescription
 * @method static \Illuminate\Database\Query\Builder|\App\Core\Models\Product whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Core\Models\Product whereUniqueId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Core\Models\Product whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Core\Models\Product whereBody($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Core\Models\Product whereModel($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Core\Models\Product whereSlug($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Core\Models\Product whereStockStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Core\Models\Product whereViewed($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Core\Models\Product whereQuantity($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Core\Models\Product whereSku($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Core\Models\Product whereUpc($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Core\Models\Product whereEan($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Core\Models\Product whereJan($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Core\Models\Product whereIsbn($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Core\Models\Product whereMpn($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Core\Models\Product wherePrice($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Core\Models\Product whereLength($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Core\Models\Product whereWidth($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Core\Models\Product whereHeight($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Core\Models\Product whereWeight($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Core\Models\Product whereDateAvailable($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Core\Models\Product whereAvailability($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Core\Models\Product whereMetaTagTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Core\Models\Product whereMetaTagDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Core\Models\Product whereMetaTagKeywords($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Core\Models\Product whereSortOrder($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Core\Models\Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Core\Models\Product whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Core\Models\Product unpublished()
 * @method static \Illuminate\Database\Query\Builder|\App\Core\Models\Product published()
 * @method static \Illuminate\Database\Query\Builder|\App\Core\Models\Product newest()
 * @method static \Illuminate\Database\Query\Builder|\App\Core\Models\Product drafted()
 * @method static \Illuminate\Database\Query\Builder|\App\Core\Models\Product bySlugOrId($id)
 * @method static \Illuminate\Database\Query\Builder|\App\Core\Models\Product categorized(\App\Core\Models\Category $category = null)
 * @method static \Illuminate\Database\Query\Builder|\App\Core\Models\Product findSimilarSlugs(\Illuminate\Database\Eloquent\Model $model, $attribute, $config, $slug)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Core\Components\Auditing\Auditing[] $audits
 */
class Product extends Model implements Transformable
{
    use TransformableTrait;
    use \Cviebrock\EloquentSluggable\Sluggable;
    use GeneratesUnique;
    use Auditable;

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

    /**
     * @var array
     */
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
     * bootable methods fix
     */
    public static function boot()
    {
        parent::boot();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productReview() {

        return $this->hasMany(ProductReview::class, "product_id");
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories() {

        return $this->belongsToMany(Category::class, 'products_categories');

    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function attributeGroupDescription()
    {
        return $this->belongsToMany(AttributeGroupDescription::class, "product_attribute", "product_id", "attr_description_id")->withPivot("value");
    }

    /**
     * @return mixed
     */
    public function getFirstCategory()
    {
        return $this->categories()->first();
    }

    /**
     * @param $date
     */
    public function setDateAvailableAttribute($date)
    {
        if(!$date) {
            $this->attributes['date_available'] = Carbon::now();
        } else {
            $this->attributes['date_available'] = $date;
        }
    }

    /**
     * @param $quantity
     */
    public function setQuantityAttribute($quantity)
    {
        if($quantity) {
            $this->attributes['quantity'] = intval($quantity);
        } else {
            $this->attributes['quantity'] = 0;
        }
    }

    /**
     * @param $query
     */
    public function scopeUnpublished($query)
    {
        $query->where('date_available', '>', Carbon::now());
    }

    /**
     * @param $query
     */
    public function scopePublished($query)
    {
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
