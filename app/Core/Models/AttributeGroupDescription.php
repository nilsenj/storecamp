<?php

namespace App\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use RepositoryLab\Repository\Contracts\Transformable;
use RepositoryLab\Repository\Traits\TransformableTrait;

/**
 * Class AttributeGroupDescription
 * @package App\Core\Models
 */
class AttributeGroupDescription extends Model implements Transformable
{
    use TransformableTrait;
    use SoftDeletes;

    /**
     * @var array
     */
    protected $fillable = ['name', 'attributes_group_id', 'sort_order', 'attr_description_id', 'product_id', 'value'];

    /**
     * @var string
     */
    protected $table = "attributes_group_description";

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function attributesGroup()
    {
        return $this->belongsTo(AttributeGroup::class, "attributes_group_id", "id");
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function product()
    {
        return $this->belongsToMany(Product::class, "product_attribute", "attr_description_id", "product_id")->withPivot("value");
    }
}
