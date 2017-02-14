<?php

namespace storecamp\htmlelements\Exceptions;

use Exception;

/**
 * Class IconException
 *
 * @package storecamp\htmlelements\Exceptions
 * @see     \storecamp\htmlelements\Facades\Icon
 */
class IconException extends Exception
{

    public static function noIconSpecified()
    {
        return new static('No icon specified when rendering the icon');
    }
}
