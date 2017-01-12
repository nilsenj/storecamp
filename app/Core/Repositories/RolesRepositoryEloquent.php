<?php

namespace App\Core\Repositories;

use App\Core\Models\Role;
use App\Core\Models\Permission;
use Illuminate\Support\Facades\Input;
use RepositoryLab\Repository\Eloquent\BaseRepository;
use RepositoryLab\Repository\Criteria\RequestCriteria;

class RolesRepositoryEloquent extends BaseRepository implements RolesRepository
{

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name' => 'like',
        'display_name' => 'like',
    ];

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Role::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * @return mixed
     */
    public function getModel()
    {
        $model = Role::class;

        return new $model;
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function store(array $data)
    {
        $listIds = $data['permissions'];
        $roleCreate = $this->getModel()->create($data);
        foreach($listIds as $key => $value ) {

            $roleCreate->attachPermission($value);
        }
        return $roleCreate;

    }

    /**
     * @param $data
     * @param $dataPerm
     * @param $role
     */
    public function renew($data, $dataPerm, $role){

        $role->update($data);

        $listIds = $dataPerm["permissions"];
        $permissionsCount = count($role->perms()->get());

        if ($permissionsCount) {
            $role->detachAllPermissions();
            foreach($listIds as $key => $value ) {
                $role->attachPermission(Permission::find($value));
            }
        }
        if ($permissionsCount == 0 && count(Input::get('permissions')) > 0) {
            foreach($listIds as $key => $value ) {
                $role->attachPermission(Permission::find($value));
            }
        }
    }
}