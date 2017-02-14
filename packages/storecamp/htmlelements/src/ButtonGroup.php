<?php
/**
 * storecamp\htmlelements Button Group class
 */

namespace storecamp\htmlelements;

use storecamp\htmlelements\Exceptions\ButtonGroupException;

/**
 * Creates Bootstrap 3 compliant Button Groups
 *
 * @package storecamp\htmlelements
 */
class ButtonGroup extends RenderedObject
{

    /**
     * @var array The contents of the button group
     */
    protected $contents = [];

    /**
     * @var string The type of the button
     */
    protected $type = 'button';

    /**
     * @var bool Whether the dropdown should be vertical or not
     */
    protected $vertical = false;

    /**
     * @var The size of the button
     */
    protected $size;

    /**
     * @var bool Whether the button group is just for links or not
     */
    protected $links = false;

    /**
     * @var array Which links should be activated
     */
    protected $activated = [];

    /**
     * Constant for large button groups
     */
    const LARGE = 'btn-group-lg';

    /**
     * Constant for small button groups
     */
    const SMALL = 'btn-group-sm';

    /**
     * Constant for extra small button groups
     */
    const EXTRA_SMALL = 'btn-group-xs';

    /**
     * Constant for normal buttons
     */
    const NORMAL = 'btn-default';

    /**
     * Constant for primary buttons
     */
    const PRIMARY = 'btn-primary';

    /**
     * Constant for success buttons
     */
    const SUCCESS = 'btn-success';

    /**
     * Constant for info buttons
     */
    const INFO = 'btn-info';

    /**
     * Constant for warning buttons
     */
    const WARNING = 'btn-warning';

    /**
     * Constant for danger buttons
     */
    const DANGER = 'btn-danger';

    /**
     * Constant for radio buttons
     */
    const RADIO = 'radio';

    /**
     * Constant for checkbox buttons
     */
    const CHECKBOX = 'checkbox';

    /**
     * Renders the button group
     *
     * @return string
     */
    public function render()
    {
        $attributes = new Attributes(
            $this->attributes,
            [
                'class' => $this->vertical ? 'btn-group-vertical' : 'btn-group',
            ]
        );

        if (!$this->links) {
            $attributes['data-toggle'] = 'buttons';
        }

        if ($this->size) {
            $attributes->addClass($this->size);
        }

        $contents = $this->renderContents();

        return "<div {$attributes}>{$contents}</div>";
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
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type)
    {
        $this->type = $type;
    }

    /**
     * @return bool
     */
    public function isVertical(): bool
    {
        return $this->vertical;
    }

    /**
     * @param bool $vertical
     */
    public function setVertical(bool $vertical)
    {
        $this->vertical = $vertical;
    }

    /**
     * @return bool
     */
    public function isLinks(): bool
    {
        return $this->links;
    }

    /**
     * @param bool $links
     */
    public function setLinks(bool $links)
    {
        $this->links = $links;
    }

    /**
     * @return array
     */
    public function getActivated(): array
    {
        return $this->activated;
    }

    /**
     * @param array $activated
     */
    public function setActivated(array $activated)
    {
        $this->activated = $activated;
    }

    /**
     * @return array
     */
    public function getAttributes(): array
    {
        return $this->attributes;
    }

    /**
     * @param array $attributes
     */
    public function setAttributes(array $attributes)
    {
        $this->attributes = $attributes;
    }

    /**
     * Sets the size of the button group
     *
     * @param $size
     */
    public function setSize($size)
    {
        $this->size = $size;
    }

    /**
     * Sets the button group to be large
     *
     * @return $this
     */
    public function large()
    {
        $this->setSize(self::LARGE);

        return $this;
    }

    /**
     * Sets the button group to be small
     *
     * @return $this
     */
    public function small()
    {
        $this->setSize(self::SMALL);

        return $this;
    }

    /**
     * Sets the button group to be extra small
     *
     * @return $this
     */
    public function extraSmall()
    {
        $this->setSize(self::EXTRA_SMALL);

        return $this;
    }

    /**
     * Sets the button group to be radio
     *
     * @param array $contents
     * @return $this
     */
    public function radio(array $contents)
    {
        return $this->asType(self::RADIO)->withContents($contents);
    }

    /**
     * Sets the button group to be a checkbox
     *
     * @param array $contents
     * @return $this
     */
    public function checkbox(array $contents)
    {
        return $this->asType(self::CHECKBOX)->withContents($contents);
    }

    /**
     * Sets the contents of the button group
     *
     * @param array $contents
     * @return $this
     */
    public function withContents(array $contents)
    {
        $this->contents = $contents;

        return $this;
    }

    /**
     * Sets the button group to be vertical
     *
     * @return $this
     */
    public function vertical()
    {
        $this->vertical = true;

        return $this;
    }

    /**
     * Sets the type of the button group
     *
     * @param $type
     * @return $this
     */
    public function asType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Renders the contents of the button group
     *
     * @return string
     * @throws ButtonGroupException if a string should be activated
     */
    public function renderContents()
    {
        $contents = '';

        if ($this->type == 'button') {
            foreach ($this->contents as $item) {
                $contents .= $item;
            }
        } else {
            foreach ($this->contents as $index => $item) {
                $active = in_array($index + 1, $this->activated);
                if ($item instanceof Button) {
                    $class = $item->getType() . ($active ? ' active' : '');
                    $value = $item->getValue();
                    $attributes = new Attributes(
                        $item->getAttributes(),
                        ['type' => $this->type]
                    );

                    $contents .= "<label class='btn {$class}'><input {$attributes}>{$value}</label>";
                } else {
                    if ($active) {
                        throw ButtonGroupException::activatedAString();
                    }
                    $contents .= $item;
                }
            }
        }

        return $contents;
    }


    public function links(array $contents = [])
    {
        $this->links = true;

        return $this->withContents($contents);
    }

    /**
     * Sets a link to be activated
     *
     * @param $toActivate
     * @return $this
     */
    public function activate($toActivate)
    {
        $this->activated = is_array($toActivate) ? $toActivate : [$toActivate];

        return $this;
    }
}
