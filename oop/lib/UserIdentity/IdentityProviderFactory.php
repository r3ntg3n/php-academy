<?php

namespace Academy\UserIdentity;

use BadMethodCallException;
use InvalidArgumentException;

class IdentityProviderFactory
{
    const AUTH_TYPE_NATIVE = 1;
    const AUTH_TYPE_GOOGLE = 2;
    const AUTH_TYPE_FACEBOOK = 3;

    private static $providerMap = [
        self::AUTH_TYPE_NATIVE => 'UserIdentity',
        self::AUTH_TYPE_GOOGLE => 'GoogleUserIdentity',
        self::AUTH_TYPE_FACEBOOK => 'FacebookUserIdentity',
    ];

    public static function build($authType)
    {
        $authType = intval($authType);
        if (!empty($authType)) {
            throw new BadMethodCallException('Authorization type required');
        }

        if (!array_key_exists($authType, self::$providerMap)) {
            throw new InvalidArgumentException('Unknown authorization type');
        }

        $className = self::$providerMap[$authType];
        return new $className();
    }
}