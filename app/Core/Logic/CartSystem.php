<?php

namespace App\Core\Logic;

use App\Core\Repositories\ProductsRepository;
use App\Core\Support\Cart\CartDbContract;
use App\Core\Support\Cart\CartSessionContract;
use app\Core\Contracts\CartSystemContract;

/**
 * Class CartSystem
 *
 * @package app\Core\Logic
 */
class CartSystem implements CartSystemContract
{
    /**
     * @var CartDbContract|CartSessionContract
     */
    public $cart;
    /**
     * @var ProductsRepository
     */
    public $productsRepository;

    /**
     * CartSystem constructor.
     * @param CartDbContract $cartDb
     * @param CartSessionContract $cartSession
     * @param ProductsRepository $productsRepository
     */
    public function __construct(CartDbContract $cartDb, CartSessionContract $cartSession,
                                ProductsRepository $productsRepository)
    {
        if (!\Auth::guest()) {
            $this->cart = $cartDb;
        } else {
            $this->cart = $cartSession;
        }
        $this->productsRepository = $productsRepository;
    }

    public function show(array $data)
    {
        $reviews = $this->cart->content();
        return $reviews;
    }

    public function addItem(array $data, $productId)
    {
        $product = $this->productsRepository->find($productId);
        $quantity = $data['quantity'] ?? 1;
        $options = $data['options'] ?? [];
        array_unshift($options, ['status' => $product->getStockStatus()]);

        return $this->cart->add($product, $quantity, $options);
    }

    public function removeItem(array $data, $cartId, $itemId)
    {

    }
    public function deleteItem(array $data, $cartId)
    {

    }

    /**
     * @return float|int
     */
    public function countItems()
    {
        return $this->cart->count();
    }


}