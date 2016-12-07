<?php

namespace Academy\Models;

class LoginFormModel
{

    private $attributes = [];
    private $identityProvider;

    public function setAttributes(array $attributes)
    {
        $this->attributes = $attributes;
    }

    public function __get($name)
    {
        return isset($this->attributes[$name])
            ? $this->attributes[$name]
            : null;
    }

    public function __set($name, $value)
    {
        $this->attributes[$name] = $value;
    }

    public function setIdentityProvider(UserIdentityInterface $identityProvider)
    {
        $this->identityProvider = $identityProvider;
        return $this;
    }

    public function authenticate()
    {
        $this->identityProvider->setAuthCredentials([
            'login' => $this->login,
            'password' => $this->password,
        ]);

        if (!$this->identityProvider->authenticate()) {
            return false;
        }

        $userIdentity = $this->identityProvider->getUserIdentity();
        \App::$i->user = $userIdentity;
        return true;
    }
}