<?php
/**
 * storecamp\htmlelements Navbar facade
 */

namespace storecamp\htmlelements\Facades;

/**
 * Facade for Navbar class
 *
 * @package storecamp\htmlelements\Facades
 * @see     \storecamp\htmlelements\Facades\Navbar
 */
class Navbar extends htmlelementsFacade
{
    const NAVBAR_INVERSE = 'navbar-inverse';
    const NAVBAR_STATIC = 'navbar-static-top';
    const NAVBAR_TOP = 'navbar-fixed-top';
    const NAVBAR_BOTTOM = 'navbar-fixed-bottom';

    /**
     * {@inheritdoc}
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'htmlelements::navbar';
    }
}
