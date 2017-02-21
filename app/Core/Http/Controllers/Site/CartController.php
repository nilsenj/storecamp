<?php

namespace App\Core\Http\Controllers\Site;

use App\Core\Contracts\CartSystemContract;

/**
 * Class CartsController
 * @package App\Core\Http\Controllers
 */
class CartController extends BaseController
{
    /**
     * @var CartSystemContract
     */
    private $cartSystem;
    private $cartRepository;

    /**
     * CartController constructor.
     *
     * @param CartSystemContract $cartSystem
     */
    public function __construct(CartSystemContract $cartSystem)
    {
        $this->cartSystem = $cartSystem;
        $this->cartRepository = $cartSystem->cartRepository;
    }
}
