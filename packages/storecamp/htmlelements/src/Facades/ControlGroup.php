<?php
/**
 * storecamp\htmlelements ControlGroup facade
 */

namespace storecamp\htmlelements\Facades;

/**
 * Facade for Control Groups
 *
 * @package storecamp\htmlelements\Facades
 * @see     ControlGroup
 */
class ControlGroup extends htmlelementsFacade
{

    /**
     * {@inheritdoc}
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'htmlelements::controlgroup';
    }
}
