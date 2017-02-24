<?php

namespace App\Core\Http\Controllers\Site;

use App\Core\Contracts\CartSystemContract;
use Illuminate\Http\Request;

/**
 * Class CartsController
 * @package App\Core\Http\Controllers
 */
class CartController extends BaseController
{
    /**
     * @var string
     */
    public $viewPathBase = "site.cart.";
    /**
     * @var string
     */
    public $errorRedirectPath = "site.cart";
    /**
     * @var CartSystemContract
     */
    private $cartSystem;

    /**
     * CartController constructor.
     *
     * @param CartSystemContract $cartSystem
     */
    public function __construct(CartSystemContract $cartSystem)
    {
        $this->cartSystem = $cartSystem;
    }

    public function show(Request $request)
    {
        $data = $request->all();
        $cart = $this->cartSystem->show($data);
        return $this->view('show', compact('cart'));
    }

    /**
     * @param Request $request
     * @param $productId
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function add(Request $request, $productId)
    {
        $data = $request->all();
        $cart = $this->cartSystem->addItem($data, $productId);
        if($request->ajax()) {
            return response()->json(['cart'=> json_encode($cart)]);
        } else {
            return redirect()->route('site::cart::show');
        }
    }

    /**
     * @param Request $request
     * @param $cartId
     * @param $itemId
     * @return \Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function remove(Request $request, $cartId, $itemId)
    {
        $data = $request->all();
        $cart = $this->cartSystem->removeItem($data, $cartId, $itemId);
        if($request->ajax()) {
            return response()->json(['cart'=> json_encode($cart), 'message' => 'cart item deleted'], 200);
        } else {
            return $this->view('index', compact('cart'));
        }

    }

    /**
     * @param Request $request
     * @param $cartId
     * @return \Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function delete(Request $request, $cartId)
    {
        $data = $request->all();
        $cart = $this->cartSystem->deleteItem($data, $cartId);
        if($request->ajax()) {
            return response()->json(['message'=> 'cart deleted'], 200);
        } else {
            return $this->view('index');
        }
    }


}
