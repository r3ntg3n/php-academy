<?php

$pageTitle = 'Welcome to my test site';

$date = date('Y-m-d H:i');
$sidebar = "Today: {$date}<br>";
if (isUserAuthorized()) {
    $username = $_COOKIE['username'];
    $sidebar .= <<<HTML
        <h4>Hello, {$username}</h4>
        <a href="index.php?page=logout">Logout</a>
HTML;
} else {
    $sidebar .= <<<HTML
        <a href="index.php?page=login">Sign in</a>
HTML;
}

$contents = '';