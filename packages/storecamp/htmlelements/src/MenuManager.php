<?php

namespace storecamp\htmlelements;

use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Contracts\View\Factory;

/**
 * Class MenuManager
 * @package storecamp\htmlelements
 */
class MenuManager
{
    /**
     *
     */
    const PLUGIN_NAME = 'elements';
    /**
     * @var Factory
     */
    protected $view;

    /**
     * @var array
     */
    protected $structureClasses;

    protected $urlRoot;

    /**
     * @param $structureClasses
     * @return MenuManager
     */
    public function setStructureClasses($structureClasses): MenuManager
    {
        $this->structureClasses = $structureClasses;
        return $this;
    }

    /**
     * @var UrlGenerator
     */
    protected $url;

    /**
     * @var array
     */
    protected $menus = [];

    /**
     * MenuManager constructor.
     *
     * @param Factory $view
     * @param UrlGenerator $url
     */
    public function __construct(Factory $view, UrlGenerator $url)
    {
        $this->view = $view;
        $this->url = $url;
        $this->structureClasses = [config('htmlelements.menu')];
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function menu($name = 'default')
    {
        if (!isset($this->menus[$name])) {
            $this->menus[$name] = new Menu($this, '', $this->structureClasses);
        }
        return $this->menus[$name];
    }

    /**
     * @param string $label
     * @return Menu
     */
    public function createMenu(string $label = ''): Menu
    {
        return new Menu($this, $label, $this->structureClasses);
    }

    /**
     * Get the view factory
     *
     * @return Factory
     */
    public function getView(): Factory
    {
        return $this->view;
    }

    /**
     * @return UrlGenerator
     */
    public function getUrl(): UrlGenerator
    {
        return $this->url;
    }

    /**
     * @return array
     */
    public function getMenus(): array
    {
        return $this->menus;
    }

    /**
     * Check if a menu item is currently active or not
     *
     * @param $menuItem
     *
     * @return bool
     */
    public function isActive($menuItem): bool
    {
        // If the `is_active` option is a callable object, return the result of this callable object with the current
        // item passed as the only argument
        if (is_callable(array_get($menuItem, 'is_active'))) {
            return (bool)call_user_func($menuItem['is_active'], $menuItem);
        }

        // If the `url_def` option is defined, use the `hieu-le/active` helper functions to calculate the result from
        // the keys and values of this array.
        if ($urlDef = array_get($menuItem, 'url_def')) {
            $result = true;
            foreach ($urlDef as $method => $value) {
                if (!is_array($value)) {
                    $result = $result && call_user_func("if_" . $method, [$value]);
                } else {
                    foreach ($value as $k => $v) {
                        $result = $result && call_user_func("if_" . $method, $k, $v);
                    }
                }
            }
            return $result;
        }

        // Default: not active
        return false;
    }

}