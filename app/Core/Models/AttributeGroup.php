<?php

namespace App\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Juggl\UniqueHashids\GeneratesUnique;
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
    use GeneratesUnique;

    public static function boot()
    {
        parent::boot();
    }
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