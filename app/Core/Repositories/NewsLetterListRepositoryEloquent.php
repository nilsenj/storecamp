<?php

namespace App\Core\Repositories;

use RepositoryLab\Repository\Eloquent\BaseRepository;
use RepositoryLab\Repository\Criteria\RequestCriteria;
use App\Core\Repositories\NewsLetterListRepository;
use App\Core\Models\NewsLetterList;

/**
 * Class NewsLetterListRepositoryEloquent
 * @package namespace SXC\Repositories;
 */
class NewsLetterListRepositoryEloquent extends BaseRepository implements NewsLetterListRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return NewsLetterList::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * get the model
     *
     * @return mixed
     */
    public function getModel()
    {
        $model = new NewsLetterList();

        return $model;
    }


}
