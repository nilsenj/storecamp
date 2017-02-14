<?php

namespace storecamp\htmlelements;

/**
 * Class Menu
 * @package storecamp\htmlelements
 */
class Menu
{

    /**
     * @var MenuManager
     */
    protected $manager;

    /**
     * @var array
     */
    protected $items = [];

    /**
     * @var string
     */
    protected $label;

    /**
     * @var
     */
    protected $rootClass;

    /**
     * @var
     */
    protected $id;

    /**
     * Menu constructor.
     * @param MenuManager $manager
     * @param string $label
     * @param array $structureClasses
     */
    public function __construct(MenuManager $manager, $label = '', $structureClasses = [])
    {
        $this->manager = $manager;
        $this->label = $label;
        $this->structureClasses = $structureClasses;
    }

    /**
     * Add new sub menu
     *
     * @param Menu  $menu
     * @param array $options
     *
     * @return Menu
     */
    public function addSubMenu(Menu $menu, $options = [])
    {
        $this->addItem($menu, $options);

        return $this;
    }

    /**
     * Add new link
     *
     * @param string $text
     * @param array  $url
     * @param array  $options
     *
     * @return Menu
     */
    public function addLink($text, array $url = [], $options = [])
    {
        $linkUrl = '#';
        $defaultIsActive = false;
        if ($to = array_get($url, 'to')) {
            $linkUrl = $this->manager->getUrl()->to($to);
        } elseif ($route = array_get($url, 'route')) {
            if (!is_array($route)) {
                $route = [$route];
            }

            $routeName = array_shift($route);
            $routeParams = $route;

            $linkUrl = $this->manager->getUrl()->route($routeName, $routeParams);
            $defaultIsActive = [
                'route'       => $routeName,
                'route_param' => $routeParams,
            ];
        } elseif ($action = array_get($url, 'action')) {
            if (!is_array($action)) {
                $action = [$action];
            }

            $actionName = array_shift($action);

            $linkUrl = $this->manager->getUrl()->action($actionName, $action);
            $defaultIsActive = [
                'action'      => $actionName,
                'route_param' => $action,
            ];
        }
        if ($query = array_get($url, 'query')) {
            $linkUrl .= '?' . http_build_query($query);
            $defaultIsActive['query'] = $query;
        }

        if (!isset($options['url_def'])) {
            $options['url_def'] = $defaultIsActive;
        }

        $this->addItem([
            'text' => $text,
            'url'  => $linkUrl,
        ], $options);

        return $this;
    }

    /**
     * Render the menu
     *
     * @param array $data
     * @param null  $view
     *
     * @return string
     */
    public function render($data = [], $view = null)
    {
        $view = $view ? : MenuManager::PLUGIN_NAME . '::menu.master_menu';
        return $this->manager->getView()->make($view, ['menu' => $this, 'structureClasses' => $this->structureClasses], $data)
            ->render();
    }

    /**
     * @return array
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param string $label
     *
     * @return Menu
     */
    public function setLabel($label)
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Add new item to this menu
     *
     * @param mixed $item
     * @param array $options
     *
     * @return Menu
     */
    protected function addItem($item, $options = [])
    {
        $nextTo = array_get($options, 'next_to');
        $position = false;
        foreach ($this->items as $index => $m) {
            if ($m['id'] == $nextTo) {
                $position = $index;
            }
        }

        $newMenu = [
            'item'      => $item,
            'before'    => array_get($options, 'before', ''),
            'after'     => array_get($options, 'after', ''),
            'url_def'   => array_get($options, 'url_def'),
            'is_active' => array_get($options, 'is_active'),
            'id'        => array_get($options, 'id'),
        ];

        if ($position !== false) {
            array_splice($this->items, $position + 1, 0, [$newMenu]);
        } else {
            $this->items[] = $newMenu;
        }
        return $this;
    }

    /**
     * trigger render function during view output
     * @return string
     */
    public function __toString()
    {
        try {
            return $this->render();
        } catch (\Exception $e) {
            $class = get_class($e);
            return "<div><p class='bg-warning text-warning'>An exception of"
                . " type <code>{$class}</code> was thrown with the message:"
                . " <code>{$e->getMessage()}</code></div>";
        }
    }

}