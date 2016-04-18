<?php

namespace Charcoal\Admin\Property\Input;

use \Charcoal\Admin\Property\AbstractPropertyInput;

/**
 *
 */
class SelectInput extends AbstractPropertyInput
{
    /**
     * @return void This method is a generator
     */
    public function choices()
    {
        $choices = $this->p()->choices();

        if ($this->p()->allowNull() && !$this->p()->multiple()) {
            $prepend = [
                'value'   => '',
                'label'   => $this->placeholder(),
                'title'   => $this->placeholder(),
                'subtext' => ''
            ];

            yield $prepend;
        }

        foreach ($choices as $choiceIdent => $choice) {
            if (!isset($choice['value'])) {
                $choice['value'] = $choiceIdent;
            }
            if (!isset($choice['label'])) {
                $choice['label'] = ucwords(strtolower(str_replace('_', ' ', $choiceIdent)));
            }
            if (!isset($choice['title'])) {
                $choice['title'] = $choice['label'];
            }
            $choice['selected'] = $this->isChoiceSelected($choiceIdent);

            yield $choice;
        }
    }

    /**
     * @param mixed $c The choice to check.
     * @return boolean
     */
    public function isChoiceSelected($c)
    {
        $val = $this->p()->val();
        if ($val === null) {
            return false;
        }
        if ($this->p()->multiple()) {
            return in_array($c, $val);
        } else {
            return $c == $val;
        }
    }
}
