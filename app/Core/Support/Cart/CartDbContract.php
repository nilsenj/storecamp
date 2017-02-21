<?php

namespace App\Core\Support\Cart;


interface CartDbContract
{
    /**
     * Add an item to the cart.
     *
     * @param $id
     * @param null $name
     * @param null $qty
     * @param null $price
     * @param array $options
     * @return array|mixed
     */
    public function add($id, $name = null, $qty = null, $price = null, array $options = []);

    /**
     * Update the cart item with the given rowId.
     *
     * @param $rowId
     * @param $qty
     * @return CartItem|void
     */
    public function update($rowId, $qty);

    /**
     * Remove the cart item with the given rowId from the cart.
     *
     * @param string $rowId
     * @return void
     */
    public function remove($rowId);

    /**
     * Get a cart item from the cart by its rowId.
     *
     * @param string $rowId
     * @return CartItem
     */
    public function get($rowId);

    /**
     * Destroy the current cart instance.
     *
     * @return void
     */
    public function destroy();
    /**
     * Get the number of items in the cart.
     *
     * @return int|float
     */
    public function count();

    /**
     * Get the total price of the items in the cart.
     *
     * @param int $decimals
     * @param string $decimalPoint
     * @param string $thousandSeperator
     * @return string
     */
    public function total($decimals = null, $decimalPoint = null, $thousandSeperator = null): string;

    /**
     * Get the total tax of the items in the cart.
     *
     * @param int $decimals
     * @param string $decimalPoint
     * @param string $thousandSeperator
     * @return float
     */
    public function tax($decimals = null, $decimalPoint = null, $thousandSeperator = null): float;

    /**
     * Get the subtotal (total - tax) of the items in the cart.
     *
     * @param int $decimals
     * @param string $decimalPoint
     * @param string $thousandSeperator
     * @return float
     */
    public function subtotal($decimals = null, $decimalPoint = null, $thousandSeperator = null): float;

    /**
     * Set the tax rate for the cart item with the given rowId.
     *
     * @param string $rowId
     * @param int|float $taxRate
     * @return void
     */
    public function setTax($rowId, $taxRate);
}