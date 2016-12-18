<?php

namespace App\Core\Repositories;

use App\Core\Entities\Role;
use App\Core\Entities\Permission;
use Illuminate\Support\Facades\Input;
use Prettus\Repository\Eloquent\BaseRepository;

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

    public function perPage()
    {
        return 10;
    }
    public function getModel()
    {
        $model = Role::class;

        return new $model;
    }
    public function allOrSearch($searchQuery = null)
    {
        if (is_null($searchQuery)) {
            return $this->getAll();
        }
        return $this->search($searchQuery);
    }
    public function getAll()
    {
        return $this->getModel()->latest()->paginate($this->perPage());
    }
    public function search($searchQuery)
    {
        $search = "%{$searchQuery}%";

        return $this->getModel()->where('name', 'like', $search)
            ->orWhere('slug', 'like', $search)
            ->paginate($this->perPage())
            ;
    }
    public function findById($id)
    {
        return $this->getModel()->find($id);
    }
    public function findBy($key, $value, $operator = '=')
    {
        return $this->getModel()->where($key, $operator, $value)->paginate($this->perPage());
    }

    public function delete($id)
    {
        $role = $this->findById($id);
        if (!is_null($role)) {
            $role->delete();
            return true;
        }
        return false;
    }
    public function create(array $data)
    {
        $listIds = $data['permissions'];
        $roleCreate = $this->getModel()->create($data);
        foreach($listIds as $key => $value ) {

            $roleCreate->attachPermission($value);
        }
        return $roleCreate;

    }

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