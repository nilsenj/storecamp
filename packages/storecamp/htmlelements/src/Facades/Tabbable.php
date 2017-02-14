<?php
/**
 * storecamp\htmlelements Tabbable facade
 */

namespace storecamp\htmlelements\Facades;

/**
 * Facade for Tabbable class
 *
 * @package storecamp\htmlelements\Facades
 * @see     \storecamp\htmlelements\Facades\Tabbable
 */
class Tabbable extends htmlelementsFacade
{
    const PILL = 'pill';
    const TAB = 'tab';

    /**
     * {@inheritdoc}
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'htmlelements::tabbable';
    }
}
