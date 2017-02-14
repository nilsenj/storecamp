<?php
/**
 * storecamp\htmlelements Carousel facade
 */

namespace storecamp\htmlelements\Facades;

/**
 * Facade for storecamp\htmlelements Carousel
 *
 * @package storecamp\htmlelements\Facades
 * @see     Carousel
 */
class Carousel extends htmlelementsFacade
{

    /**
     * {@inheritdoc}
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'htmlelements::carousel';
    }
}
