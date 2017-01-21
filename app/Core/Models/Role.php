<?php


namespace App\Core\Models;

use Illuminate\Database\Eloquent\Model;
use App\Core\Access\AccessRole;
use Juggl\UniqueHashids\GeneratesUnique;
use RepositoryLab\Repository\Contracts\Transformable;
use RepositoryLab\Repository\Traits\TransformableTrait;

/**
 * Class Role
 * @package App
 */
class Role extends AccessRole implements Transformable
{
    use TransformableTrait;
    use GeneratesUnique;

    protected $fillable = ['name', 'display_name', 'description'];

    /**
     * bootable methods fix
     */
    public static function boot()
    {
        parent::boot();
    }

    /**
     * @return array
     */
    public function getRoleIds()
    {
        $roleAdminArr = $this->users()->get();

        $adminArr = array();

        foreach ($roleAdminArr as $key => $admin) {

            $adminArr[] = $admin->id;
        }
        return array_values($adminArr);
    }

    /**
     * @param $query
     */
    public function scopeWhereAdmin($query){

       $query->where("name", "Admin");
    }

    /**
     * detach all permissions
     */
    public function detachAllPermissions()
    {
        $this->perms()->sync([]);
    }
    /**
     * @param string $name
     * @return mixed
     */
    public function getRoleUsers(string $name)
    {
        $user = new User();
        $roleUsers = $user->getUsersByRole($name);

        return $roleUsers;
    }
}
