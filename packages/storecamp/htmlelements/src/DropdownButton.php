<?php
/**
 * storecamp\htmlelements DropdownButton class
 */

namespace storecamp\htmlelements;

/**
 * Creates Bootstrap 3 compliant Dropdown Buttons
 *
 * @package storecamp\htmlelements
 */
/**
 * Class DropdownButton
 * @package storecamp\htmlelements
 */
class DropdownButton extends RenderedObject
{
    /**
     * Divider constant
     */
    const DIVIDER = "<li class='divider'></li>";

    /**
     * Constant for primary buttons
     */
    const PRIMARY = 'btn-primary';

    /**
     * Constant for danger buttons
     */
    const DANGER = 'btn-danger';

    /**
     * Constant for warning buttons
     */
    const WARNING = 'btn-warning';

    /**
     * Constant for success buttons
     */
    const SUCCESS = 'btn-success';

    /**
     * Constant for default buttons
     */
    const NORMAL = 'btn-default';

    /**
     * Constant for info buttons
     */
    const INFO = 'btn-info';

    /**
     * Constant for large buttons
     */
    const LARGE = 'btn-lg';

    /**
     * Constant for small buttons
     */
    const SMALL = 'btn-sm';

    /**
     * Constant for extra small buttons
     */
    const EXTRA_SMALL = 'btn-xs';

    /**
     * @var string The label for this button
     */
    protected $label;

    /**
     * @var array The contents of the dropdown button
     */
    protected $contents = [];

    /**
     * @var string The type of the button
     */
    protected $type = 'btn-default';

    /**
     * @var string The size of the button
     */
    protected $size;

    /**
     * @var bool Whether the drop icon should be a seperate button
     */
    protected $split = false;

    /**
     * @var bool Whether the button should drop up
     */
    protected $dropup = false;

    /**
     * Set the label of the button
     *
     * @param $label
     * @return $this
     */
    public function labelled($label)
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Set the contents of the button
     *
     * @param array $contents The contents of the dropdown button
     * @return $this
     */
    public function withContents(array $contents)
    {
        $this->contents = $contents;

        return $this;
    }

    /**
     * Sets the type of the button
     *
     * @param string $type The type of the button
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Sets the size of the button
     *
     * @param string $size The size of the button
     * @return $this
     */
    public function setSize($size)
    {
        $this->size = $size;

        return $this;
    }

    /**
     * Splits the button
     *
     * @return $this
     */
    public function split()
    {
        $this->split = true;

        return $this;
    }

    /**
     * Sets the button to drop up
     *
     * @return $this
     */
    public function dropup()
    {
        $this->dropup = true;

        return $this;
    }

    /**
     * Creates a normal dropdown button
     *
     * @param string $label The label
     * @return $this
     */
    public function normal($label = '')
    {
        $this->setType(self::NORMAL);

        return $this->labelled($label);
    }

    /**
     * Creates a primary dropdown button
     *
     * @param string $label The label
     * @return $this
     */
    public function primary($label = '')
    {
        $this->setType(self::PRIMARY);

        return $this->labelled($label);
    }

    /**
     * Creates a danger dropdown button
     *
     * @param string $label The label
     * @return $this
     */
    public function danger($label = '')
    {
        $this->setType(self::DANGER);

        return $this->labelled($label);
    }

    /**
     * Creates a warning dropdown button
     *
     * @param string $label The label
     * @return $this
     */
    public function warning($label = '')
    {
        $this->setType(self::WARNING);

        return $this->labelled($label);
    }

    /**
     * Creates a success dropdown button
     *
     * @param string $label The label
     * @return $this
     */
    public function success($label = '')
    {
        $this->setType(self::SUCCESS);

        return $this->labelled($label);
    }

    /**
     * Creates a info dropdown button
     *
     * @param string $label The label
     * @return $this
     */
    public function info($label = '')
    {
        $this->setType(self::INFO);

        return $this->labelled($label);
    }

    /**
     * Sets the size to large
     *
     * @return $this
     */
    public function large()
    {
        $this->setSize(self::LARGE);

        return $this;
    }


    /**
     * Sets the size to small
     *
     * @return $this
     */
    public function small()
    {
        $this->setSize(self::SMALL);

        return $this;
    }

    /**
     * Sets the size to extra small
     *
     * @return $this
     */
    public function extraSmall()
    {
        $this->setSize(self::EXTRA_SMALL);

        return $this;
    }

    /**
     * Renders the dropdown button
     *
     * @return string
     */
    public function render()
    {
        $attributes = $this->attributes;
        $instance = $this;
        $view = view('elements::dropdown-button', compact('instance', 'attributes'));
        $contents = (string)$view;
        return $contents;

    }

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * @param string $label
     */
    public function setLabel(string $label)
    {
        $this->label = $label;
    }

    /**
     * @return array
     */
    public function getContents(): array
    {
        return $this->contents;
    }

    /**
     * @param array $contents
     */
    public function setContents(array $contents)
    {
        $this->contents = $contents;
    }

    /**
     * @return bool
     */
    public function isSplit(): bool
    {
        return $this->split;
    }

    /**
     * @return bool
     */
    public function getSplit()
    {
        return $this->split;
    }

    /**
     * @param bool $split
     */
    public function setSplit(bool $split)
    {
        $this->split = $split;
    }

    /**
     * @return bool
     */
    public function isDropup(): bool
    {
        return $this->dropup;
    }

    /**
     * @param bool $dropup
     */
    public function setDropup(bool $dropup)
    {
        $this->dropup = $dropup;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @return bool
     */
    public function getDropup()
    {
        return $this->dropup;
    }

    /**
     * Render the inner items
     *
     * @return string
     */
    public function renderItems()
    {
        $string = '';
        foreach ($this->contents as $item) {
            if (is_array($item)) {
                $string .= "<li><a href='{$item['url']}'>{$item['label']}</a></li>";
            } else {
                $string .= $item;
            }
        }

        return $string;
    }
}
