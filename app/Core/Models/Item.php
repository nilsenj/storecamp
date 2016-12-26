<?php

namespace App\Core\Models;

use Illuminate\Database\Eloquent\Model;
use RepositoryLab\Repository\Contracts\Transformable;
use RepositoryLab\Repository\Traits\TransformableTrait;

/**
 * Class Item
 * @package FBA\Models
 */
class Item extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * @var string
     */
    protected $table = "items";

    /**
     * @var array
     */
    protected $fillable = ['type', 'weight'];


    /**
     * @param array $itemIds
     * @return array
     */
    public function getItemsWeight(array $itemIds) {

        $items = $this->whereIn('id', $itemIds)->select('weight')->get();
        $itemsArr = [];
        foreach ($items as $key => $item) {
            $itemsArr[] = $item->weight;
        }
        return $itemsArr;
    }
}
