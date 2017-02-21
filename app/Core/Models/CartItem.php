<?php

namespace App\Core\Models;

use App\Core\Contracts\CartItemInterface;
use App\Core\Traits\CartItemTrait;
use Illuminate\Database\Eloquent\Model;
use App\Core\Traits\GeneratesUnique;
use RepositoryLab\Repository\Contracts\Transformable;
use RepositoryLab\Repository\Traits\TransformableTrait;
use Config;

class CartItem extends Model implements Transformable, CartItemInterface
{
    use TransformableTrait;
    use GeneratesUnique;
    use CartItemTrait;

    public static function boot()
    {
       parent::boot();
    }

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table;

    /**
     * Name of the route to generate the item url.
     *
     * @var string
     */
    protected $itemRouteName = '';

    /**
     * Name of the attributes to be included in the route params.
     *
     * @var string
     */
    protected $itemRouteParams = [];

    /**
     * Name of the attributes to be included in the route params.
     *
     * @var string
     */
    protected $fillable = ['user_id', 'cart_id', 'shop_id', 'sku', 'price', 'tax', 'shipping', 'currency', 'quantity', 'class', 'reference_id'];

    /**
     * Creates a new instance of the model.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = Config::get('shop.item_table');
    }

    /**
     * Many-to-Many relations with the user model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(Config::get('auth.providers.users.model'), 'user_id');
    }

    /**
     * One-to-One relations with the cart model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cart()
    {
        return $this->belongsTo(Config::get('shop.cart'), 'cart_id');
    }

    /**
     * One-to-One relations with the order model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
        return $this->belongsTo(Config::get('shop.order'), 'order_id');
    }
}
