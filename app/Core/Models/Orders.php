<?php

namespace App\Core\Models;

use Illuminate\Database\Eloquent\Model;
use App\Core\Traits\GeneratesUnique;
use RepositoryLab\Repository\Contracts\Transformable;
use RepositoryLab\Repository\Traits\TransformableTrait;

/**
 * App\Core\Models\Orders
 *
 * @property int $id
 * @property string $unique_id
 * @property int $user_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Core\Models\Orders whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Core\Models\Orders whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Core\Models\Orders whereUniqueId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Core\Models\Orders whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Core\Models\Orders whereUserId($value)
 * @mixin \Eloquent
 */
class Orders extends Model implements Transformable
{
    use TransformableTrait;
    use GeneratesUnique;
    protected $table = "orders";
    protected $fillable = [
    ];

    public static function boot()
    {
       parent::boot();
    }

}
