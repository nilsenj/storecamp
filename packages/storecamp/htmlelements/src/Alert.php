<?php
/**
 * storecamp\htmlelements Alert class
 */

namespace storecamp\htmlelements;

/**
 * Creates Bootstrap 3 compliant alert boxes
 *
 * @package storecamp\htmlelements
 * @author  Patrick Rose
 */
class Alert extends RenderedObject
{

    /**
     * Constant for info alerts
     */
    const INFO = 'alert-info';

    /**
     * Constant for success alerts
     */
    const SUCCESS = 'alert-success';

    /**
     * Constant for warning alerts
     */
    const WARNING = 'alert-warning';

    /**
     * Constant for danger alerts
     */
    const DANGER = 'alert-danger';

    /**
     * @var string The type of the alert
     */
    protected $type;

    /**
     * @var string The contents of the alert
     */
    protected $contents;

    /**
     * @var string What should we use to generate a close tag
     */
    protected $closer;

    /**
     * Sets the type of the alert. The alert prefix is not assumed.
     *
     * @param $type string
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Renders the alert
     *
     * @return string
     */
    public function render()
    {
        $attributes = $this->attributes;
        $type = $this->type;
        $closer = $this->closer;
        $contents = $this->contents;
        $view = view('elements::alert', compact('attributes', 'closer', 'contents', 'type'));
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
     * @return string
     */
    public function getCloser(): string
    {
        return $this->closer;
    }

    /**
     * @param string $closer
     * @return $this
     */
    public function setCloser(string $closer)
    {
        $this->closer = $closer;
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
     * Creates an info alert box
     *
     * @param string $contents
     * @return $this
     */
    public function info($contents = '')
    {
        return $this->setType(self::INFO)->withContents($contents);
    }

    /**
     * Creates a success alert box
     *
     * @param string $contents
     * @return $this
     */
    public function success($contents = '')
    {
        return $this->setType(self::SUCCESS)->withContents($contents);
    }

    /**
     * Creates a warning alert box
     *
     * @param string $contents
     * @return $this
     */
    public function warning($contents = '')
    {
        return $this->setType(self::WARNING)->withContents($contents);
    }

    /**
     * Creates a danger alert box
     *
     * @param string $contents
     * @return $this
     */
    public function danger($contents = '')
    {
        return $this->setType(self::DANGER)->withContents($contents);
    }

    /**
     * Sets the contents of the alert box
     *
     * @param $contents
     * @return $this
     */
    public function withContents($contents)
    {
        $this->contents = $contents;

        return $this;
    }

    /**
     * Adds a close button with the given text
     *
     * @param string $closer
     * @return $this
     */
    public function close($closer = '&times;')
    {
        $this->closer = $closer;

        return $this;
    }
}
