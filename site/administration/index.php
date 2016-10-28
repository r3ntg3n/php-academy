<?php

if (!isset($_SERVER['PHP_AUTH_USER'])) {
    header('WWW-Authenticate: Basic realm="My protected administration"');
    header('HTTP/1.0 401 Unathorized');
    echo 'You have not entered your credetials.';
    exit;
} else {
    echo "<p>Hello, {$_SERVER['PHP_AUTH_USER']}</p>";
    echo "<p>You have entered <strong>{$_SERVER['PHP_AUTH_PW']}</strong> as password</p>";
}
