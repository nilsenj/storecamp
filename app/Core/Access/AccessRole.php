<?php namespace App\Core\Access;

/**
 * This file is part of Access,
 * a role & permission management solution for Syrinx.
 *
 * @license MIT
 * @package App\Core\Access
 */

use App\Core\Access\Contracts\AccessRoleInterface;
use App\Core\Access\Traits\AccessRoleTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class AccessRole extends Model implements AccessRoleInterface
{
    use AccessRoleTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table;

    /**
     * Creates a new instance of the model.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = Config::get('access.roles_table');
    }

}
