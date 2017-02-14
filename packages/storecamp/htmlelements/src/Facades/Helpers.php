<?php
/**
 * storecamp\htmlelements Helper facade
 */

namespace storecamp\htmlelements\Facades;

/**
 * Facade for the helpers class
 *
 * @package storecamp\htmlelements\Facades
 * @see     Helpers
 */
class Helpers extends htmlelementsFacade
{

    /**
     * {@inheritdoc}
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'htmlelements::helpers';
    }
}
