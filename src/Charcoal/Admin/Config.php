<?php

namespace Charcoal\Admin;

use \InvalidArgumentException as InvalidArgumentException;

// From `charcoal-core`
use \Charcoal\Config\AbstractConfig as AbstractConfig;

class Config extends AbstractConfig
{
    const DEFAULT_BASE_PATH = 'admin';

    /**
    * @var string $_base_path
    */
    private $_base_path = self::DEFAULT_BASE_PATH;

    /**
    * @param string|array $data
    */
    public function __construct($data = null)
    {
        // Relative to src/Charcoal/Admin/
        $this->add_file(realpath(__DIR__.'/../../../config').'/admin.config.default.json');

        parent::__construct($data);
    }

    /**
    * @param array $data
    * @throws InvalidArgumentException
    * @return Config Chainable
    */
    public function set_data($data)
    {
        if (!is_array($data)) {
            throw new InvalidArgumentException('Data must be an array');
        }

        if (isset($data['base_path'])) {
            $this->set_base_path($data['base_path']);
        }

        return $this;
    }

    /**
    * @param string $path
    * @throws InvalidArgumentException
    * @return Config Chainable
    */
    public function set_base_path($path)
    {
        if (!is_string($path)) {
            throw new InvalidArgumentException('Path must be a string');
        }
        // Can not be empty
        if ($path == '') {
            throw new InvalidArgumentException('Path can not be empty');
        }
        $this->_base_path = $path;
        return $this;
    }

    public function base_path()
    {
        return $this->_base_path;
    }

}
