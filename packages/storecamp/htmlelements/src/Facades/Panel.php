<?php
/**
 * storecamp\htmlelements panel facade
 */

namespace storecamp\htmlelements\Facades;

/**
 * Facade for the Panel class
 *
 * @package storecamp\htmlelements\Facades
 * @see \storecamp\htmlelements\Facades\Panel
 */
class Panel extends htmlelementsFacade
{

    const PRIMARY = 'panel-primary';
    const SUCCESS = 'panel-success';
    const INFO = 'panel-info';
    const WARNING = 'panel-warning';
    const DANGER = 'panel-danger';
    const NORMAL = 'panel-default';

    /**
     * {@inheritdoc}
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'htmlelements::panel';
    }
}
