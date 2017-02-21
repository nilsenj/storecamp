<?php

namespace App\Core\Logic;

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
     * CartSystem constructor.
     * @param CartDbContract $cartDb
     * @param CartSessionContract $cartSession
     */
    public function __construct(CartDbContract $cartDb, CartSessionContract $cartSession)
    {
        if (!\Auth::guest()) {
            $this->cart = $cartDb;
        } else {
            $this->cart = $cartSession;
        }
    }
}