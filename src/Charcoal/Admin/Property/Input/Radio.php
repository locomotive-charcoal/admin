<?php

namespace Charcoal\Admin\Property\Input;

use \InvalidArgumentException as InvalidArgumentException;

use \Charcoal\Admin\Property\Input as Input;

class Radio extends Input
{

    public function choices()
    {
        return $this->p()->choices();
    }
}
