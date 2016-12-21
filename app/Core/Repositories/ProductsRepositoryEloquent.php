<?php

namespace App\Core\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Core\Repositories\ProductsRepository;
use App\Core\Entities\Product;

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
    public function perPage()
    {
        return 10;
    }
    public function getModel()
    {
        $model = $this->model();

        return new $model;
    }

    public function getProduct()
    {
        return $this->getModel()->onlyGood();
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
        return $this->getProduct()->latest()->paginate($this->perPage());
    }
    public function search($searchQuery)
    {
        $search = "%{$searchQuery}%";

        return $this->getProduct()->where('title', 'like', $search)
            ->orWhere('body', 'like', $search)
            ->orWhere('id', '=', $searchQuery)
            ->paginate($this->perPage())
            ;
    }
    public function findById($id)
    {
        return $this->getProduct()->find($id);
    }
    public function findBy($key, $value, $operator = '=')
    {
        return $this->getProduct()->where($key, $operator, $value)->paginate($this->perPage());
    }
    public function delete($id)
    {
        $good = $this->findById($id);
        if (!is_null($good)) {
            $good->delete();
            return true;
        }
        return false;
    }
    public function create(array $data)
    {
        return $this->getModel()->create($data);
    }

}
