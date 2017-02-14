<?php
/**
 * storecamp\htmlelements Modal facade
 */

namespace storecamp\htmlelements\Facades;

/**
 * Facade for the Modal class
 *
 * @package storecamp\htmlelements\Facades
 */
class Modal extends htmlelementsFacade
{

    /**
     * {@inheritdoc}
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'htmlelements::modal';
    }
}
