<?php

namespace Charcoal\Admin\Property\Input;

use \Charcoal\Admin\Property\AbstractPropertyInput;

/**
 * Audio Property Input
 */
class AudioInput extends AbstractPropertyInput
{
    /**
     * @var mixed $message
     */
    private $message;

    /**
     * @var mixed $audio_data
     */
    private $audio_data;

    /**
     * @var mixed $audio_file
     */
    private $audio_file;

    /**
     * @param mixed $message The audio message.
     * @return AudioInput Chainable
     */
    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @return mixed
     */
    public function message()
    {
        return $this->message;
    }
}
