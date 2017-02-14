<?php
/**
 * storecamp\htmlelements Media Object facade
 */

namespace storecamp\htmlelements\Facades;

/**
 * Facade for MediaObject class
 *
 * @package storecamp\htmlelements\Facades
 * @see     MediaObject
 */
class MediaObject extends htmlelementsFacade
{

    /**
     * {@inheritdoc}
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'htmlelements::mediaobject';
    }
}
