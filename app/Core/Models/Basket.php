<?php

namespace App\Core\Models;

use Illuminate\Database\Eloquent\Model;
use RepositoryLab\Repository\Contracts\Transformable;
use RepositoryLab\Repository\Traits\TransformableTrait;

/**
 * Class Basket
 * @package FBA\Models
 */
class Basket extends Model implements Transformable
{
    use TransformableTrait;
    use \Eloquent\Dialect\Json;

    /**
     * @var string
     */
    protected $table = 'baskets';

    /**
     * @var array
     */
    protected $fillable = ['name', 'contents', 'max_capacity'];

    /**
     * @var array
     */
    protected $jsonColumns = ['contents'];

    /**
     * @var array
     */
    protected $casts = [
        'contents' => 'json',
    ];

    /**
     * @return mixed
     */
    public function getBasketContents()
    {
        $content = json_decode($this->contents, true);
        $contentsArr = [];
        foreach ($content as $itemArr) {
            $contentsArr['items'][] = $itemArr['item_id'];
            $contentsArr['weight'][] = $itemArr['weight'];
        }
        return $contentsArr;
    }

    /**
     * add item to basket
     * @param $id
     * @throws \Exception
     */
    public function addItem($id)
    {
        $items = $this->getBasketContents();
        $itemInstance = new Item();
        $addedItem = Item::findOrFail($id);

        if (!empty($items)) {
            $itemIds = $items['items'];
            $contents = $itemInstance->getItemsWeight($itemIds);
            $weight = array_sum($contents);
            $futureWeight = intval($addedItem->weight) + intval($weight);
            foreach ($itemIds as $id) {
                if (intval($addedItem->id) == intval($id)) {
                    throw new \Exception($message = "The item is already in the basket", $code = 400);
                }
            }
        } else {
            $addedItem = Item::find($id);
            $futureWeight = $addedItem->weight;
        }

        if (abs($this->max_capacity) >= abs($futureWeight)) {
            $itemContents = json_decode($this->contents, true);
            array_push($itemContents, ['item_id' => $addedItem->id, 'weight' => $addedItem->weight]);
            $this->contents = json_encode($itemContents);
            $this->save();
        } else {
            throw new \Exception($message = "The basket is overloaded", $code = 400);
        }
    }

    /**
     * delete the item from the basket
     *
     * @param $id
     * @throws \Exception
     */
    public function deleteItem($id)
    {
        $items = $this->getBasketContents();
        if (!empty($items)) {
            $itemIds = $items['items'];
            $deletedItem = Item::find($id);
            $countNotFoundItems = 0;
            foreach ($itemIds as $id) {
                if (intval($deletedItem->id) == intval($id)) {
                    $countNotFoundItems++;
                }
            }
            if ($countNotFoundItems < 1) {
                throw new \Exception($message = "The item not found in the basket", $code = 400);
            }
            $itemContents = json_decode($this->contents, true);
            $newContentsArr = [];
            foreach ($itemContents as $itemsArr) {
                if (intval($itemsArr['item_id']) != intval($deletedItem->id)) {
                    array_push($newContentsArr, $itemsArr);
                }
            }
            $this->contents = json_encode($newContentsArr);
            $this->save();
        } else {
            throw new \Exception($message = "The Basket don't have items", $code = 400);
        }
    }

    /**
     * get active items from the basket
     * 
     * @param array $existingIds
     * @return array|static[]
     */
    public function getActiveItems(array $existingIds)
    {
        return \DB::table('items')->whereIn('id', $existingIds)
            ->orderBy('created_at')->select('id', 'weight', 'type')->get();
    }

    /**
     * get non-active items from the basket
     * 
     * @param array $existingIds
     * @return array|static[]
     */
    public function getNonActiveItems(array $existingIds)
    {
        return \DB::table('items')->whereNotIn('id', $existingIds)
            ->orderBy('created_at')->select('id', 'weight', 'type')->get();
    }

    /**
     * prepare or get items attached to the basket
     * 
     * @return array
     */
    public function prepareItems()
    {
        $content = json_decode($this->contents, true);
        $contentsArr = [];
        if (!empty($content)) {
            foreach ($content as $key => $itemArr) {
                $itemId = $itemArr['item_id'];
                $item = Item::where('id', $itemId)->select('id', 'type', 'weight');
                $contentsArr['items'][] = $item->get(['id', 'type', 'weight']);
            }
            $items = $this->getBasketContents();
            $itemInstance = new Item();
            $itemIds = $items['items'];
            $contents = $itemInstance->getItemsWeight($itemIds);
            $currentBasketSum = array_sum($contents);
        } else {
            $contentsArr = [];
            $currentBasketSum = [];
        }
        return [$contentsArr, $currentBasketSum];
    }
}
