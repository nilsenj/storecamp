<?php
/**
 * storecamp\htmlelements Image facade
 */

namespace storecamp\htmlelements\Facades;

/**
 * Facade for the Label class
 *
 * @package storecamp\htmlelements\Facades
 * @see     \storecamp\htmlelements\Facades\Label
 */
class Label extends htmlelementsFacade
{

    const LABEL_PRIMARY = 'label-primary';
    const LABEL_SUCCESS = 'label-success';
    const LABEL_INFO = 'label-info';
    const LABEL_WARNING = 'label-warning';
    const LABEL_DANGER = 'label-danger';
    const LABEL_DEFAULT = 'label-default';

    /**
     * {@inheritdoc}
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'htmlelements::label';
    }
}
