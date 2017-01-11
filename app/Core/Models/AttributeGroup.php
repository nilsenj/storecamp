<?php

namespace App\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use RepositoryLab\Repository\Contracts\Transformable;
use RepositoryLab\Repository\Traits\TransformableTrait;

/**
 * Class AttributeGroup
 * @package App\Core\Models
 */
class AttributeGroup extends Model implements Transformable
{
    use TransformableTrait;
    use SoftDeletes;

    /**
     * @var array
     */
    protected $fillable = ['name', 'sort_order'];
    /**
     * @var string
     */
    protected $table = "attributes_group";

    /**
     *
     */
    public function attributeGroupDescription()
    {
        $this->hasMany(AttributeGroupDescription::class, "attributes_group_id");
    }

}
