<?php

namespace Charcoal\Admin\Template;

// From 'charcoal-translation'
use \Charcoal\Translation\TranslationString;

// From 'charcoal-admin'
use \Charcoal\Admin\AdminTemplate as AdminTemplate;

/**
 * Admin Lost Password Template
 */
class LostPasswordTemplate extends AdminTemplate
{
    /**
     * Authentication is obviously never required for the lost-password page.
     *
     * @return boolean
     */
    protected function authRequired()
    {
        return false;
    }

    /**
     * @return boolean
     */
    public function showHeaderMenu()
    {
        return false;
    }

    /**
     * @return boolean
     */
    public function showFooterMenu()
    {
        return false;
    }

    /**
     * Retrieve the title of the page.
     *
     * @return TranslationString|string|null
     */
    public function title()
    {
        if ($this->title === null) {
            $this->setTitle([
                'en' => 'Lost Password',
                'fr' => 'Mot de passe oublié',
            ]);
        }

        return $this->title;
    }
}
