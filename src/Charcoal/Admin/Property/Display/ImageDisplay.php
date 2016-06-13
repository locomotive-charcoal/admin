<?php

namespace Charcoal\Admin\Property\Display;

use \Charcoal\Admin\Property\AbstractPropertyDisplay;

/**
 * Image Display Property
 */
class ImageDisplay extends AbstractPropertyDisplay
{
    /**
     * @var mixed $val
     */
    protected $val;

    /**
     * Width of the image
     * @var string $width (ex: 100px)
     */
    protected $width = 'auto';

    /**
     * Height of the image
     * @var string $height (ex: 100px)
     */
    protected $height = 'auto';

    /**
     * Max-width of the image
     * Default: none
     * @var string $maxWidth (ex:100px)
     */
    protected $maxWidth = 'none';

    /**
     * Max-height of the image
     * Default: none
     * @var string $maxHeight (ex:100px)
     */
    protected $maxHeight = 'none';

    /**
     * Width setter
     * If integer specified, 'px' will be append to it
     * @param mixed $width CSS value.
     * @return ImageDisplay Chainable
     */
    public function setWidth($width)
    {
        if (is_numeric($width)) {
            $width .= 'px';
        }
        $this->width = $width;
        return $this;
    }

    /**
     * Width getter
     * Default @see $this->setWidth()
     * @return string
     */
    public function width()
    {
        return $this->width;
    }

    /**
     * Height setter
     * If integer specified, 'px' will be append to it
     * @param string $height CSS value.
     * @return ImageDisplay Chainable
     */
    public function setHeight($height)
    {
        if (is_numeric($height)) {
            $height .= 'px';
        }
        $this->height = $height;
        return $this;
    }

    /**
     * Height getter
     * Default @see $this->setHeight()
     * @return string
     */
    public function height()
    {
        return $this->height;
    }


    /**
     * Width setter
     * If integer specified, 'px' will be append to it
     * @param string $maxWidth CSS value.
     * @return ImageDisplay Chainable
     */
    public function setMaxWidth($maxWidth)
    {
        if (is_numeric($maxWidth)) {
            $maxWidth .= 'px';
        }
        $this->maxWidth = $maxWidth;
        return $this;
    }

    /**
     * MaxWidth getter
     * Default @see $this->setMaxWidth()
     * @return string
     */
    public function maxWidth()
    {
        return $this->maxWidth;
    }

    /**
     * Height setter
     * If integer specified, 'px' will be append to it
     * @param string $maxHeight CSS value.
     * @return ImageDisplay Chainable
     */
    public function setMaxHeight($maxHeight)
    {
        if (is_numeric($maxHeight)) {
            $maxHeight .= 'px';
        }
        $this->maxHeight = $maxHeight;
        return $this;
    }

    /**
     * Height getter
     * Default @see $this->setMaxHeight()
     * @return string
     */
    public function maxHeight()
    {
        return $this->maxHeight;
    }
}
