<?php
/**
 * storecamp\htmlelements Badge facade
 */

namespace storecamp\htmlelements\Facades;

/**
 * Facade for storecamp\htmlelements Badges
 *
 * @package storecamp\htmlelements\Facades
 * @see     Badge
 */
class Badge extends htmlelementsFacade
{

    /**
     * {@inheritdoc}
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'htmlelements::badge';
    }
}
