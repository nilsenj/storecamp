<?php

namespace FBA\Transformers;

use App\Core\Models\Item;
use League\Fractal\TransformerAbstract;
use App\Core\Models\Basket;

/**
 * Class BasketTransformer
 * @package namespace FBA\Transformers;
 */
class BasketTransformer extends TransformerAbstract
{

    /**
     * Transform the \Basket entity
     * @param Basket $model
     * @return array
     */
    public function transform(Basket $model)
    {
        $contentsArr = $model->prepareItems(); // get the items attached
        $contents = $contentsArr[0]; // basic content
        $currentBasketSum = $contentsArr[1]; // get total contents weight
        
        return [
            'id'         => (int) $model->id,
            'name' => $model->name,
            'max_capacity' => $model->max_capacity,
            'contents' => $contents,
            'current_basket_sum' => $currentBasketSum,
            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
