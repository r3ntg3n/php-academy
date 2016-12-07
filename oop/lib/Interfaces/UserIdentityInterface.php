<?php

namespace Academy\Interfaces;

/**
 * UserIdentityInterface is a common interface
 * for any class, that represents user identity instance.
 */
interface UserIdentityInterface
{
    public function setAuthCredentials(array $credentials);
    public function authenticate();
    public function getUserIdentity();
}
