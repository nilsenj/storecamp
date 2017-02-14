<?php
/**
 * storecamp\htmlelements Table facade
 */

namespace storecamp\htmlelements\Facades;

/**
 * Facade for the Table class
 *
 * @package storecamp\htmlelements\Facades
 * @see     \storecamp\htmlelements\Facades\Table
 */
class Table extends htmlelementsFacade
{

    const TABLE_STRIPED = 'table-striped';
    const TABLE_BORDERED = 'table-bordered';
    const TABLE_HOVER = 'table-hover';
    const TABLE_CONDENSED = 'table-condensed';

    /**
     * {@inheritdoc}
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'htmlelements::table';
    }
}
