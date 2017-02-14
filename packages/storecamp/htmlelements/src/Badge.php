<?php
/**
 * storecamp\htmlelements Badge class
 */

namespace storecamp\htmlelements;

/**
 * Creates Bootstrap 3 compliant Badges
 *
 * @package storecamp\htmlelements
 */
class Badge extends RenderedObject
{

    /**
     * @var string The contents of the badge
     */
    protected $contents;

    /**
     * Renders the badge
     *
     * @return string
     */
    public function render()
    {
        $attributes = $this->attributes;
        $contents = $this->contents;
        $view = view('elements::badge', compact('contents', 'attributes'));
        $contents = (string) $view;
        return $contents;
    }

    /**
     * @return string
     */
    public function getContents(): string
    {
        return $this->contents;
    }

    /**
     * @param string $contents
     * @return $this
     */
    public function setContents(string $contents)
    {
        $this->contents = $contents;
        return $this;
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
     * @return $this
     */
    public function setAttributes(array $attributes)
    {
        $this->attributes = $attributes;
        return $this;
    }

    /**
     * Adds contents to the badge
     *
     * @param $contents
     * @return $this
     */
    public function withContents($contents)
    {
        $this->contents = $contents;

        return $this;
    }
}
