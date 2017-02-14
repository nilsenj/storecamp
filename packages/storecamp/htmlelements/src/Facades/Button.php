<?php
/**
 * storecamp\htmlelements Button facade
 */

namespace storecamp\htmlelements\Facades;

/**
 * Facade for Button class
 *
 * @package storecamp\htmlelements\Facades
 * @see     Button
 */
class Button extends htmlelementsFacade
{
    const PRIMARY = 'btn-primary';
    const SUCCESS = 'btn-success';
    const INFO = 'btn-info';
    const WARNING = 'btn-warning';
    const DANGER = 'btn-danger';
    const LINK = 'btn-link';
    const LARGE = 'btn-lg';
    const SMALL = 'btn-sm';
    const EXTRA_SMALL = 'btn-xs';

    /**
     * {@inheritdoc}
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'htmlelements::button';
    }
}
