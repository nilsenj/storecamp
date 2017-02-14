<?php
/**
 * storecamp\htmlelements InputGroup facade
 */

namespace storecamp\htmlelements\Facades;

/**
 * Facade for InputGroup class
 *
 * @package storecamp\htmlelements\Facades
 * @see     \storecamp\htmlelements\Facades\InputGroup
 */
class InputGroup extends htmlelementsFacade
{

    const LARGE = 'input-group-lg';
    const SMALL = 'input-group-sm';

    /**
     * {@inheritdoc}
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'htmlelements::inputgroup';
    }
}
