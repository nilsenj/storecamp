<?php
/**
 * storecamp\htmlelements Alert facade
 */

namespace storecamp\htmlelements\Facades;

/**
 * Facade for storecamp\htmlelements Alerts
 *
 * @package storecamp\htmlelements\Facades
 * @see     Alert
 */
class Alert extends htmlelementsFacade
{
    const INFO = 'alert-info';
    const SUCCESS = 'alert-success';
    const WARNING = 'alert-warning';
    const DANGER = 'alert-danger';

    /**
     * {@inheritdoc}
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'htmlelements::alert';
    }
}
