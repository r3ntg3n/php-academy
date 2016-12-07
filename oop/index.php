<?php

require 'config/autoload.php';

use Academy\Ldap\User;

$user = new User();
$provider = new stdClass;
$provider->active = true;
try {
    $user->setProvider($provider);
} catch (BadMethodCallException $e) {
    echo $e->getMessage() . PHP_EOL;
} finally {
    echo 'Go home' . PHP_EOL;
}