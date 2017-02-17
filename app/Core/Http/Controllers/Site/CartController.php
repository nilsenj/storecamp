<?php

namespace App\Core\Http\Controllers\Site;

use App\Core\Contracts\CartSystemContract;
use Illuminate\Http\Request;
use App\Core\Models\Cart;
use App\Core\Repositories\CartRepository;
use App\Core\Http\Controllers\Controller;

/**
 * Class CartsController
 * @package App\Core\Http\Controllers
 */
class CartController extends Controller {

    /**
     * TODO implement store carts in db after order
     * is initiated by the user
     **/

    /**
     * TODO display cart items stored in db as a history
     */

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
