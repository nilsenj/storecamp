<?php
/**
 * storecamp\htmlelements Thumbnail facade
 */

namespace storecamp\htmlelements\Facades;

/**
 * Facade for Thumbnails
 *
 * @package storecamp\htmlelements\Facades
 * @see     \storecamp\htmlelements\Facades\Thumbnail
 */
class Thumbnail extends htmlelementsFacade
{

    /**
     * {@inheritdoc}
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'htmlelements::thumbnail';
    }
}
