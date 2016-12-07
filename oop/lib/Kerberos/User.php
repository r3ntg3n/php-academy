<?php

namespace Academy\Kerberos;

use \Academy\Traits\LdapUserInitTrait;

/**
 * Kerberos service user class.
 */
class User
{
    use LdapUserInitTrait;

    /**
     * Initialies LDAP backend.
     */
    public function __construct()
    {
    }
}
