<?php

namespace App\Core\Contracts;


use App\Core\Support\Cart\CartItem;
use Illuminate\Support\Collection;

/**
 * Interface CartSystemContract
 * @package app\Core\Contracts
 */
interface CartSystemContract
{
    public function show(array $data);
    public function addItem(array $data, $productId);
    public function removeItem(array $data, $cartId, $productId);
    public function deleteItem(array $data, $cartId);
    public function countItems();
}