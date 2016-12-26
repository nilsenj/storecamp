<?php
/**
 * Created by PhpStorm.
 * User: nilse
 * Date: 5/18/2016
 * Time: 11:58 PM
 */

namespace App\Core\Transformers;


use App\Core\Models\Basket;
use App\Core\Models\Item;
use League\Fractal\TransformerAbstract;

class BasketsForItemTransformer extends TransformerAbstract
{

    /**
     * @param Basket $model
     * @return array
     */
    public function transform(Basket $model)
    {
        $content = json_decode($model->contents, true);
        $contentsArr = [];
        foreach ($content->items as $itemId) {
            $item = Item::where('id', $itemId);
            $contentsArr['items'][] = $item->get();
            $contentsArr['weight'][] = $item->select('weight')->first()['weight'];
        }
        $currentBasketSum = array_sum($contentsArr['weight']);
        $contents = $contentsArr;

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
