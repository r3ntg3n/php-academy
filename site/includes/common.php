<?php

const PAGES_PATH = __DIR__ . '/pages';
const AUTH_TOKEN_SALT = 'phpAc!@#%#@';

/**
 * Renders the content of the page
 *
 * @param string $page Page name to render.
 *
 * @return string
 */
function renderPage($page)
{
    $filename = PAGES_PATH . "/{$page}.php";
    ob_start();
    include $filename;
    include 'header.php';
    include 'footer.php';
    $content = ob_get_contents();
    ob_clean();
    return $content;
}

/**
 * Checks if required page file exists.
 *
 * @param string $page Page name,
 *
 * @return boolean
 */
function isPageExists($page)
{
    $filename = PAGES_PATH . "/{$page}.php";
    return file_exists($filename)
        && is_readable($filename);
}

/**
 * Checks if current user has been authorized.
 *
 * @return boolean
 */
function isUserAuthorized()
{
    if (empty($_COOKIE['authToken'])
        && empty($_COOKIE['username'])
    ) {
        return false;
    }

    $token = $_COOKIE['authToken'];
    $users = require 'users.php';
    $tokens = file('tokenStorage.txt');
    $tokens = array_map('unserialize', $tokens);
    
    $tokensIndex = array_column($tokens, 'username', 'token');
    return array_key_exists($token, $tokensIndex);
}

/**
 * Returns `$param` parameter value from `$requestArray`.
 * @param array  $requestArray Request array.
 * @param string $param        Parameter name.
 * @param mixed  $default      Default values if parameter does not exist.
 *
 * @return mixed
 */
function getParamsFromRequest(array $requestArray, $param, $default = null)
{
    return !empty($requestArray[$param])
        ? $requestArray[$param]
        : $default;
}

/**
 * Authorized user by username and password.
 *
 * @param string $username Login.
 * @param string $password Password.
 *
 * @return boolean
 */
function authorizeUser($username, $password)
{
    $users = require 'users.php';
    if (!array_key_exists($username, $users)) {
        return false;
    }

    $userData = $users[$username];
    if ($password !== $userData['password']) {
        return false;
    }

    $checksum = strrev("{$username}^^^{$password}");
    $checksum .= AUTH_TOKEN_SALT;
    $checksum = sha1($checksum);

    $cookieExpires = time() + 7200;
    setcookie('authToken', $checksum, $cookieExpires);
    setcookie('username', $userData['firstName'], $cookieExpires);
    saveAuthToken($username, $checksum);
    return true;
}

function saveAuthToken($username, $token) 
{
    $storageFile = 'tokenStorage.txt';
    $entry = ['username' => $username, 'token' => $token];
    $line = serialize($entry) . PHP_EOL;
    file_put_contents($storageFile, $line, FILE_APPEND);
}

function deleteAuthToken($token)
{
    $storageFile = 'tokenStorage.txt';
    $tokens = file($storageFile);
    $tokens = array_map('unserialize', $tokens);
    $index = array_column($tokens, 'token');
    $index = array_flip($index);
    if (array_key_exists($token, $index)) {
        $tokenPosition = $index[$token];
        unset($tokens[$tokenPosition]);
    }

    unset($index);

    $tokens = array_map('serialize', $tokens);
    file_put_contents($storageFile, implode(PHP_EOL, $tokens));
}
