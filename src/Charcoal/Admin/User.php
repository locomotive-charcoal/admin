<?php

namespace Charcoal\Admin;

// Module `charcoal-base` dependencies
use \Charcoal\User\AbstractUser;

// Local namespace dependencies
use \Charcoal\Admin\UserConfig;
use \Charcoal\Admin\UserGroup;

/**
 * Admin User class.
 */
class User extends AbstractUser
{
    /**
     * @return string
     */
    public static function sessionKey()
    {
        return 'admin.user';
    }

    /**
     * ConfigurableInterface > createConfig()
     *
     * @param array|null $data Optional. User config data.
     * @return UserConfig
     */
    public function createConfig(array $data = null)
    {
        $config = new UserConfig();
        if ($data !== null) {
            $config->merge($data);
        }
        return $config;
    }

    /**
     * @param array|null $data Optional. Default usergroup data.
     * @return UserGroup
     */
    public function createGroup(array $data = null)
    {
        $group =  new UserGroup();
        if ($data !== null) {
            $group->setData($data);
        }
        return $group;
    }

    /**
     * @param array $data Optional permission data.
     * @return array
     */
    public function createPermission(array $data = null)
    {
        unset($data);
        return [];
    }
}
