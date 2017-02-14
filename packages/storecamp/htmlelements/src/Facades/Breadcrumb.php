<?php
/**
 * storecamp\htmlelements Breadcrumb facade
 */

namespace storecamp\htmlelements\Facades;

/**
 * Facade for the Breadcrumb class
 *
 * @package storecamp\htmlelements\Facades
 * @see     Breadcrumb
 */
class Breadcrumb extends htmlelementsFacade
{

    /**
     * {@inheritdoc}
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'htmlelements::breadcrumb';
    }
}
