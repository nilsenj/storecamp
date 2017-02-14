<?php
/**
 * storecamp\htmlelements Navigation facade
 */

namespace storecamp\htmlelements\Facades;

/**
 * Facade for the Navigation class
 *
 * @package storecamp\htmlelements\Facades
 * @see     \storecamp\htmlelements\Facades\Navigation
 */
class Navigation extends htmlelementsFacade
{

    const NAVIGATION_PILLS = 'nav-pills';
    const NAVIGATION_TABS = 'nav-tabs';
    const NAVIGATION_NAVBAR = 'navbar-nav';
    const NAVIGATION_DIVIDER = 'divider';

    /**
     * {@inheritdoc}
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'htmlelements::navigation';
    }
}
