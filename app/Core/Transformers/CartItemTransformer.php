<?php

namespace App\Core\Transformers;

use League\Fractal\TransformerAbstract;
use App\Core\Models\CartItem;

/**
 * Class CartItemTransformer
 * @package namespace App\Core\Transformers;
 */
class CartItemTransformer extends TransformerAbstract
{

    /**
     * Transform the \CartItem entity
     * @param \CartItem $model
     *
     * @return array
     */
    public function transform(CartItem $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
