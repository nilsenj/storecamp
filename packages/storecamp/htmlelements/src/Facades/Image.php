<?php
/**
 * storecamp\htmlelements Image facade
 */

namespace storecamp\htmlelements\Facades;

/**
 * Facade for Image class
 *
 * @package storecamp\htmlelements\Facades
 * @see     Image
 */
class Image extends htmlelementsFacade
{

    const IMAGE_RESPONSIVE = 'img-responsive';
    const IMAGE_ROUNDED = 'img-rounded';
    const IMAGE_CIRCLE = 'img-circle';
    const IMAGE_THUMBNAIL = 'img-thumbnail';

    /**
     * {@inheritdoc}
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'htmlelements::image';
    }
}
