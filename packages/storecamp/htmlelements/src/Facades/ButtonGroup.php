<?php
/**
 * storecamp\htmlelements Button Group facade
 */

namespace storecamp\htmlelements\Facades;

/**
 * Facade for ButtonGroup
 *
 * @package storecamp\htmlelements\Facades
 * @see     ButtonGroup
 */
class ButtonGroup extends htmlelementsFacade
{
    const LARGE = 'btn-group-lg';
    const SMALL = 'btn-group-sm';
    const EXTRA_SMALL = 'btn-group-xs';

    const NORMAL = 'btn-default';
    const PRIMARY = 'btn-primary';
    const SUCCESS = 'btn-success';
    const INFO = 'btn-info';
    const WARNING = 'btn-warning';
    const DANGER = 'btn-danger';

    /**
     * {@inheritdoc}
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'htmlelements::buttongroup';
    }
}
