<?php

use Illuminate\Database\Seeder;

class CartItemsSeeder extends Seeder
{
    protected $cartSystem;

    /**
     * CartItemsSeeder constructor.
     *
     * @param $cartSystem
     */
    public function __construct(\App\Core\Contracts\CartSystemContract $cartSystem)
    {
        $this->cartSystem = $cartSystem;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = \App\Core\Models\Product::all();

        foreach ($products as $product) {
            $cart = $this->cartSystem->add($product, 1, ["some" => "option"]);
            $this->cartSystem->store($cart->rowId);
//            $this->cartSystem->restore($cart->rowId);// Just for  test
        }
    }
}
