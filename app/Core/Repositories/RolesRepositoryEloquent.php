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
     * @return int
     */
    public function perPage()
    {
        return 10;
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
     * @param null $searchQuery
     * @return mixed
     */
    public function allOrSearch($searchQuery = null)
    {
        if (is_null($searchQuery)) {
            return $this->getAll();
        }
        return $this->search($searchQuery);
    }

    /**
     * @return mixed
     */
    public function getAll()
    {
        return $this->getModel()->latest()->paginate($this->perPage());
    }

    /**
     * @param $searchQuery
     * @return mixed
     */
    public function search($searchQuery)
    {
        $search = "%{$searchQuery}%";

        return $this->getModel()->where('name', 'like', $search)
            ->orWhere('slug', 'like', $search)
            ->paginate($this->perPage())
            ;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function findById($id)
    {
        return $this->getModel()->find($id);
    }

    /**
     * @param $key
     * @param $value
     * @param string $operator
     * @return mixed
     */
    public function findBy($key, $value, $operator = '=')
    {
        return $this->getModel()->where($key, $operator, $value)->paginate($this->perPage());
    }

    /**
     * @param $id
     * @return bool
     */
    public function delete($id)
    {
        $role = $this->findById($id);
        if (!is_null($role)) {
            $role->delete();
            return true;
        }
        return false;
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
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