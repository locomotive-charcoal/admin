<?php

namespace Charcoal\Admin\Template;

// From PSR-7
use Psr\Http\Message\RequestInterface;

// From 'charcoal-admin'
use Charcoal\Admin\AdminTemplate;
use Charcoal\Admin\Template\AuthTemplateTrait;
use Charcoal\Admin\User;
use Charcoal\Admin\User\AuthToken;

/**
 * Log Out template
 */
class LogoutTemplate extends AdminTemplate
{
    use AuthTemplateTrait {
        AuthTemplateTrait::avatarImage as loginLogo;
    }

    /**
     * @param RequestInterface $request The request to initialize.
     * @return boolean
     */
    public function init(RequestInterface $request)
    {
        $user = User::getAuthenticated($this->modelFactory());
        if ($user) {
            $result = $user->logout();
            $this->deleteUserAuthTokens($user);
        }

        return parent::init($request);
    }

    /**
     * @param User $user The user to clear auth tokens for.
     * @return LogoutTemplate Chainable
     */
    private function deleteUserAuthTokens(User $user)
    {
        $token = $this->modelFactory()->create(AuthToken::class);

        if ($token->source()->tableExists()) {
            $q = sprintf('DELETE FROM %s WHERE user_id = :userId', $token->source()->table());
            $token->source()->dbQuery($q, [
                'userId' => $user->id()
            ]);
        }

        return $this;
    }

    /**
     * Authentication is obviously never required for the login page.
     *
     * @return boolean
     */
    protected function authRequired()
    {
        return false;
    }

    /**
     * @return string
     */
    public function avatarImage()
    {
        $logo = $this->adminConfig('logout.logo') ?:
                $this->adminConfig('logout_logo', 'assets/admin/images/avatar.jpg');

        if (empty($logo)) {
            return $this->loginLogo();
        }

        return $this->baseUrl($logo);
    }

    /**
     * Retrieve the title of the page.
     *
     * @return \Charcoal\Translator\Translation|string|null
     */
    public function title()
    {
        if ($this->title === null) {
            $this->setTitle($this->translator()->translation('auth.logout.title'));
        }

        return $this->title;
    }



    // Templating
    // =========================================================================

    /**
     * Determine if main & secondary menu should appear as mobile in a desktop resolution.
     *
     * @return boolean
     */
    public function isFullscreenTemplate()
    {
        return true;
    }
}
