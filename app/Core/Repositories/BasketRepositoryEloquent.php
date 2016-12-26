<?php

namespace App\Core\Repositories;

use App\Core\Presenters\BasketPresenter;
use RepositoryLab\Repository\Eloquent\BaseRepository;
use RepositoryLab\Repository\Criteria\RequestCriteria;
use App\Core\Repositories\BasketRepository;
use App\Core\Models\Basket;
/**
 * Class BasketRepositoryEloquent
 * @package namespace FBA\Repositories;
 */
class BasketRepositoryEloquent extends BaseRepository implements BasketRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Basket::class;
    }

    protected $skipPresenter = false;

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
    public function getModel() {
        
        return new Basket();
    }

//    public function presenter()
//    {
//        return BasketPresenter::class;
//    }

}
