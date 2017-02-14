<?php
/**
 * storecamp\htmlelements Accordion facade
 */

namespace storecamp\htmlelements\Facades;

/**
 * Facade for Accordions
 *
 * @package storecamp\htmlelements\Facades
 * @see     Accordion
 */
class Accordion extends htmlelementsFacade
{

    /**
     * {@inheritdoc}
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'htmlelements::accordion';
    }
}
