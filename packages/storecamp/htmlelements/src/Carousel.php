<?php
/**
 * storecamp\htmlelements Carousel class
 */

namespace storecamp\htmlelements;

/**
 * Creates Bootstrap 3 compliant carousels
 *
 * @package storecamp\htmlelements
 */
class Carousel extends RenderedObject
{

    /**
     * @var string The name of the carousel
     */
    protected $name;

    /**
     * @var string The icon or text for the control's previous slide
     */
    protected $previousButton = "<span class='glyphicon glyphicon-chevron-left' aria-hidden=\"true\"></span>";
    /**
     * @var string The icon or text for the control's next slide
     */
    protected $nextButton = "<span class='glyphicon glyphicon-chevron-right' aria-hidden=\"true\"></span>";

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName(string $name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getPreviousButton(): string
    {
        return $this->previousButton;
    }

    /**
     * @param string $previousButton
     * @return $this
     */
    public function setPreviousButton(string $previousButton)
    {
        $this->previousButton = $previousButton;
        return $this;
    }

    /**
     * @return string
     */
    public function getNextButton(): string
    {
        return $this->nextButton;
    }

    /**
     * @param string $nextButton
     * @return $this
     */
    public function setNextButton(string $nextButton)
    {
        $this->nextButton = $nextButton;
        return $this;
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
     * @return $this
     */
    public function setContents(array $contents)
    {
        $this->contents = $contents;
        return $this;
    }

    /**
     * @return int
     */
    public function getActive(): int
    {
        return $this->active;
    }

    /**
     * @param int $active
     * @return $this
     */
    public function setActive(int $active)
    {
        $this->active = $active;
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
     * @var array The contents of the carousel. Should be an array of arrays,
     * with the inner arrays having the following keys:
     * <dl><dt>image</dt><dd>A path to the image</dd> <dt>alt</dt><dd>The alt
     * text for the image</dd> <dt>caption (optional)</dt><dd>The caption for
     * that slide</dd></dl>
     */
    protected $contents = [];

    /**
     * @var int Which slide should be active at the beginning
     */
    protected $active = 0;

    /**
     * Names the carousel
     *
     * @param string $name The name of the carousel
     * @return $this
     */
    public function named($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Set the control icons or text
     *
     * @param string $previousButton Left arrorw, previous text
     * @param string $nextButton     right arrow, next string
     * @return $this
     */
    public function withControls($previousButton, $nextButton)
    {
        $this->previousButton = $previousButton;
        $this->nextButton = $nextButton;
        return $this;
    }

    /**
     * Sets the contents of the carousel
     *
     * @param array $contents The new contents. Should be an array of arrays,
     *                        with the inner keys being "image", "alt" and
     *                        (optionally) "caption"
     * @return $this
     */
    public function withContents(array $contents)
    {
        $this->contents = $contents;

        return $this;
    }

    /**
     * Renders the carousel
     *
     * @return string
     */
    public function render()
    {
        if (!$this->name) {
            $this->name = Helpers::generateId($this);
        }
        $name = $this->name;
        $attributes = $this->attributes;
        $instance = $this;
        $view = view('elements::carousel', compact('instance', 'name', 'attributes'));
        $contents = (string) $view;
        return $contents;
    }

    /**
     * Renders the indicators
     *
     * @return string
     */
    public function renderIndicators()
    {
        $string = "<ol class='carousel-indicators'>";
        $count = count($this->contents);
        for ($i = 0; $i < $count; $i++) {
            if ($i == $this->active) {
                $string .= "<li data-target='#{$this->name}' data-slide-to='{$i}' class='active'></li>";
            } else {
                $string .= "<li data-target='#{$this->name}' data-slide-to='{$i}'></li>";
            }
        }
        $string .= "</ol>";

        return $string;
    }

    /**
     * Renders the items of the carousel
     *
     * @return string
     */
    public function renderItems()
    {
        $string = "<div class='carousel-inner' role=\"listbox\">";
        $count = 0;
        foreach ($this->contents as $item) {
            if ($count == $this->active) {
                $string .= "<div class='item active'>";
            } else {
                $string .= "<div class='item'>";
            }
            $string .= "<img src='{$item['image']}' alt='{$item['alt']}'>";
            if (isset($item['caption'])) {
                $string .= "<div class='carousel-caption'>{$item['caption']}</div>";
            }
            $string .= "</div>";
            $count++;
        }
        $string .= "</div>";

        return $string;
    }

    /**
     * Renders the controls of the carousel
     *
     * @return string
     */
    public function renderControls()
    {
        return "<a class='left carousel-control' href='#{$this->name}' role=\"button\"  data-slide='prev'>"
            . "{$this->previousButton}<span class=\"sr-only\">Prev</span></a><a class='right carousel-control' href='#{$this->name}' data-slide='next'>"
            . "{$this->nextButton} <span class=\"sr-only\">Next</span></a>";
    }
}
