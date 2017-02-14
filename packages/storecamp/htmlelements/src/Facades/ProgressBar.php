<?php
/**
 * storecamp\htmlelements ProgressBar facade
 */

namespace storecamp\htmlelements\Facades;

/**
 * Facade for ProgressBar
 *
 * @package storecamp\htmlelements\Facades
 * @see     \storecamp\htmlelements\Facades\ProgressBar
 */
class ProgressBar extends htmlelementsFacade
{

    const PROGRESS_BAR_SUCCESS = 'progress-bar-success';
    const PROGRESS_BAR_INFO = 'progress-bar-info';
    const PROGRESS_BAR_WARNING = 'progress-bar-warning';
    const PROGRESS_BAR_DANGER = 'progress-bar-danger';
    const PROGRESS_BAR_NORMAL = 'progress-bar-default';

    /**
     * {@inheritdoc}
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'htmlelements::progressbar';
    }
}
