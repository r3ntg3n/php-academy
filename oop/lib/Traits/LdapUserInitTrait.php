<?php

namespace Academy\Traits;

use \Academy\Ldap\User;

/**
 * Trait LdapUserInitTrait is used for
 * LDAP user instance initialization.
 */
trait LdapUserInitTrait
{

    /**
     * User instance.
     *
     * @var User
     */
    private $ldapUser;

    /**
     * Returns LDAP user instance.
     *
     * @return User
     */
    protected function getLdapUser()
    {
        if (empty($this->ldapUser)) {
            $this->ldapUser = new User();
        }

        return $this->ldapUser;
    }
}