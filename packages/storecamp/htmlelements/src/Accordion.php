<?php
/**
 * storecamp\htmlelements Accordion class
 */

namespace storecamp\htmlelements;

/**
 * Creates Bootstrap 3 compliant accordions
 *
 * @package storecamp\htmlelements
 * @author  Patrick Rose
 */
class Accordion extends RenderedObject
{

    /**
     * @var String name of the object (used when creating the links)
     */
    protected $name;

    /**
     * @var array The contents of the accordion
     */
    protected $contents = [];

    /**
     * @var int Which panel (if any) should be opened
     */
    protected $opened = -1;

    /**
     * Name the accordion
     *
     * @param $name The name of the accordion
     * @return $this
     */
    public function named($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Add the contents for the accordion. Should be an array of arrays
     * <strong>Expected Keys</strong>:
     * <ul>
     * <li>title</li>
     * <li>contents</li>
     * <li>attributes (optional)</li>
     * </ul>
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
     * Sets which panel should be opened. Numbering begins from 0.
     *
     * @param $integer int
     * @return $this
     */
    public function open($integer)
    {
        $this->opened = $integer;

        return $this;
    }

    /**
     * Renders the accordion
     *
     * @return string
     */
    public function render()
    {
        if (!$this->name) {
            $this->name = Helpers::generateId($this);
            $name = $this->name;
        } else {
            $name = $this->name;
        }

        $attributes = $this->attributes;
        $contents = $this->contents;
        $opened = $this->opened;
        $view = view('elements::accordion', compact('attributes', 'name', 'contents', 'opened'));
        $contents = (string) $view;
        return $contents;
    }
}
