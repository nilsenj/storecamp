<?php

namespace App\Core\Repositories;

use RepositoryLab\Repository\Eloquent\BaseRepository;
use RepositoryLab\Repository\Criteria\RequestCriteria;
use App\Core\Repositories\ProductsRepository;
use App\Core\Models\Product;

/**
 * Class ProductsRepositoryEloquent
 * @package namespace App\Core\Repositories;
 */
class ProductsRepositoryEloquent extends BaseRepository implements ProductsRepository
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Product::class;
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
        $model = $this->model();

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
        return $this->getModel()->latest()->paginate();
    }

    /**
     * @param $searchQuery
     * @return mixed
     */
    public function search($searchQuery)
    {
        $search = "%{$searchQuery}%";

        return $this->getModel()->where('title', 'like', $search)
            ->orWhere('body', 'like', $search)
            ->orWhere('id', '=', $searchQuery)
            ->paginate($this->perPage())
            ;
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
        $good = $this->find($id);
        if (!is_null($good)) {
            $good->delete();
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
        return $this->getModel()->create($data);
    }

}
