<?php

namespace App\Core\Logic;

use App\Core\Contracts\CategorySystemContract;
use App\Core\Repositories\CategoryRepository;

/**
 * Class CategorySystem
 * @package App\Core\Logic
 */
class CategorySystem implements CategorySystemContract
{
    /**
     * @var CategoryRepository
     */
    public $categoryRepository;

    /**
     * CategorySystem constructor.
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @param array $data
     * @param null $id
     * @param array $with
     * @return mixed
     */
    public function present(array $data, $id = null, array $with = [])
    {
        if ($id) {
            $categories = $this->categoryRepository->find($id);
        } else {
            if(!empty($with)) {
                $categories = $this->categoryRepository->with($with)->order('parent_id', 'ASC')->paginate();
            } else {
                $categories = $this->categoryRepository->byParent()->paginate();
            }
        }
        return $categories;
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        $category = $this->categoryRepository->create($data);
        return $category;
    }

    /**
     * @param array $data
     * @param $id
     * @return mixed
     */
    public function update(array $data, $id)
    {
        $data['top'] = $data->top ? $data->top == "on" ? true : false : false;
        $data["parent_id"] = empty($data["parent_id"]) ? null : $data["parent_id"];
        $category = $this->categoryRepository->find($id);
        $category->update($data);
        return $category;
    }

    /**
     * @param $id
     * @param array $data
     * @return int
     */
    public function delete($id, array $data = []) : int
    {
        $deleted = $this->categoryRepository->delete($id);
        return $deleted;
    }
}