<?php

namespace App\Core\Transformers;

use League\Fractal\TransformerAbstract;
use App\Core\Models\Item;

/**
 * Class ItemTransformer
 * @package namespace FBA\Transformers;
 */
class ItemTransformer extends TransformerAbstract
{

    /**
     * @param Item $model
     * @return array
     */
    public function transform(Item $model)
    {
        return [
            'id'         => (int) $model->id,
            'type' => $model->type,
            'weight' => $model->weight,
            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
