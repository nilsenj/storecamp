<?php

namespace App\Core\Repositories;

use RepositoryLab\Repository\Eloquent\BaseRepository;
use RepositoryLab\Repository\Criteria\RequestCriteria;
use App\Core\Repositories\CategoryRepository;
use App\Core\Models\Category;

/**
 * Class CategoryRepositoryEloquent
 * @package namespace App\Core\Repositories;
 */
class CategoryRepositoryEloquent extends BaseRepository implements CategoryRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Category::class;
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
        $model = Category::class;

        return new $model;
    }

    /**
     * @return int
     */
    public function perPage()
    {
        return 10;
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
        $category = $this->findById($id);
        if (!is_null($category)) {
            $category->delete();
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

    /**
     * @return mixed
     */
    public function getCategories(){

        $categories = $this->getModel()->where('parent_id', null)->get();//united

        $categories = $this->addRelation($categories);

        return $categories;

    }

    /**
     * @param $id
     * @return mixed
     */
    protected function selectChild($id)
    {
        $categories = $this->getModel()->where('parent_id',$id)->get(); //rooney

        $categories = $this->addRelation($categories);

        return $categories;

    }

    /**
     * @param $categories
     * @return mixed
     */
    protected function addRelation($categories){

        $categories->map(function ($item, $key) {

            $sub = $this->selectChild($item->id);

            return $item = array_add($item,'subCategory',$sub);

        });

        return $categories;
    }
}
