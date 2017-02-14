<?php
/**
 * storecamp\htmlelements Icon facade
 */

namespace storecamp\htmlelements\Facades;

/**
 * Facade for Icon class
 *
 * @package storecamp\htmlelements\Facades
 * @see     Icon
 */
class Icon extends htmlelementsFacade
{

    /**
     * {@inheritdoc}
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'htmlelements::icon';
    }
}
