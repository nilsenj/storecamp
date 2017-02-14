<?php

namespace storecamp\htmlelements\Exceptions;

use Exception;

class ButtonGroupException extends Exception
{

    public static function activatedAString()
    {
        return new self(
            'ButtonGroups can only activate options that are instances of storecamp\htmlelements\\Button'
        );
    }
}
