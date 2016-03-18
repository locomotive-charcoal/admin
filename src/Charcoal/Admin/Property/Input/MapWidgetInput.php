<?php

namespace Charcoal\Admin\Property\Input;

// Module `charcoal-admin` dependencies
use \Charcoal\Admin\Property\AbstractPropertyInput;

/**
 *
 */
class MapWidgetInput extends AbstractPropertyInput
{
    /**
     * @var array $mapOptions
     */
    private $mapOptions = [];

    /**
     * @param array $mapOptions The map options.
     * @return MapWidgetInput Chainable
     */
    public function setMapOptions(array $mapOptions)
    {
        $this->mapOptions = $mapOptions;
        return $this;
    }

    /**
     * Get the map options as JSON-encoded string.
     *
     * @return string
     */
    public function mapOptions()
    {
        return json_encode($this->mapOptions, true);
    }
}
