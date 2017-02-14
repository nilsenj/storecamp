<?php
/**
 * storecamp\htmlelements Breadcrumb class
 */

namespace storecamp\htmlelements;

/**
 * Creates Bootstrap 3 compliant Breadcrumbs
 *
 * @package storecamp\htmlelements
 */
class Breadcrumb extends RenderedObject
{
    /**
     * @var array The links of the breadcrumb
     */
    protected $links = [];

    /**
     * Renders the breadcrumb
     *
     * @return string
     */
    public function render()
    {
        $attr = $this->attributes;
        $links = $this->links;
        $instance = $this;
        $view = view('elements::breadcrumb', compact('links', 'attr', 'instance'));
        $contents = (string) $view;
        return $contents;
    }

    /**
     * @return array
     */
    public function getLinks(): array
    {
        return $this->links;
    }

    /**
     * @param array $links
     * @return $this
     */
    public function setLinks(array $links)
    {
        $this->links = $links;
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
     * Set the links for the breadcrumbs. Expects an array of the following:
     * <ul>
     * <li>An array, with keys <code>link</code> and <code>text</code></li>
     * <li>A string for the active link
     * </ul>
     *
     * @param $links array
     * @return $this
     */
    public function withLinks(array $links)
    {

        $this->links = $links;

        return $this;
    }

    /**
     * Renders the link
     *
     * @param $text
     * @param $link
     * @return string
     */
    public function renderLink($text, $link)
    {
        $string = "";
        if (is_string($text)) {
            $string .= "<li>";
            $string .= "<a href='{$link}'>{$text}</a>";
        } else {
            $string .= "<li class='active'>";
            $string .= $link;
        }
        $string .= "</li>";

        return $string;
    }
}
