<?php
/**
 * Created by PhpStorm.
 * User: nilse
 * Date: 5/18/2016
 * Time: 11:57 PM
 */

namespace App\Core\Transformers;


use App\Core\Models\Basket;
use App\Core\Models\Item;
use League\Fractal\TransformerAbstract;

class ItemsForBasketTransformer extends TransformerAbstract
{

    /**
     * Transform the \Basket entity to show
     * the items that belong and with statuses
     * included or active
     */
    public function transform(Basket $model)
    {
        $content = $model->getBasketContents();
        if (!empty($content)) {
            $contentsArr = $content['weight'];
            $existingIds = $content['items'];
            $existingIds = array_values($existingIds);
            $items['active'] = $model->getActiveItems($existingIds);
            $items['non_active'] = $model->getNonActiveItems($existingIds);
            $currentBasketSum = array_sum($contentsArr);
        } else {
            $items['active'] = [];
            $items['non_active'] = Item::all();
            $currentBasketSum = 0;
            $contentsArr = [0];
        }
        return [
            'id'         => (int) $model->id,
            'name' => $model->name,
            'max_capacity' => $model->max_capacity,
            'items' => $items,
            'contents' => $contentsArr,
            'current_basket_sum' => $currentBasketSum,
            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }

}