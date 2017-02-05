<?php

namespace App\Core\Repositories;

use App\Core\Eloquent\BaseRepository;
use App\Core\Criteria\RequestCriteria;
use App\Core\Repositories\OrderRepository;
use App\Core\Models\Order;

/**
 * Class OrderRepositoryEloquent
 * @package namespace App\Core\Repositories;
 */
class OrderRepositoryEloquent extends BaseRepository implements OrderRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Order::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
