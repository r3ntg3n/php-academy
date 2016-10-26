<?php

$expire = time() - 100;
$token = $_COOKIE['authToken'];
deleteAuthToken($token);

setcookie('authToken', null, $expire);
setcookie('username', null, $expire);
unset($_COOKIE['auth'], $_COOKIE['username']);
header('Location: index.php?page=login');
exit;