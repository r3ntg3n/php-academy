<?php

namespace Academy\Ldap;

use \Academy\Base\BaseUser;

/**
 * Class User represents LDAP catalog service user.
 */
class User extends BaseUser
{
    protected function prepareCriteria(array $criteria)
    {
        return $this->buildLdapQuery($criteria);
    }

    private function buildLdapQuery(array $criteria)
    {
        $query = '';
        /// MAGIC!!!
        return $query;
    }
}