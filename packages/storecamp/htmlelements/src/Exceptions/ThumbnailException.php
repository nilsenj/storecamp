<?php
/**
 * storecamp\htmlelements Thumbnail Exception
 */

namespace storecamp\htmlelements\Exceptions;

/**
 * Exception used by the Thumbnail class
 *
 * @package storecamp\htmlelements\Exceptions
 * @see     \storecamp\htmlelements\Facades\Thumbnail
 */
class ThumbnailException extends \Exception
{

    /**
     * Use if the image has not been set on the Thumbnail
     *
     * @return \storecamp\htmlelements\Exceptions\ThumbnailException
     */
    public static function imageNotSpecified(): ThumbnailException
    {
        return new static(
            'You must specify the image using the "image" method'
        );
    }
}
