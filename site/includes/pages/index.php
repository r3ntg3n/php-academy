<?php

$pageTitle = 'Welcome to my test site';

$date = date('Y-m-d H:i');
$sidebar = "Today: {$date}<br>";
$selectedStyle = !empty($_SESSION['style'])
    ? $_SESSION['style']
    : null;

$defaultChecked = '';
$v2Checked = '';
switch($selectedStyle) {
    case 'v2':
        $v2Checked = 'checked';
        break;

    default:
        $defaultChecked = 'checked';
        break;
}

if (isUserAuthorized()) {
    $username = $_COOKIE['username'];
    $sidebar .= <<<HTML
        <h4>Hello, {$username}</h4>
        <a href="index.php?page=logout">Logout</a><br>
        <p>Pick your theme:</p>
        <form action="index.php?page=changeStyle" method="post">
            <input type="radio" name="style" value="default" {$defaultChecked}> Default style
            <br>
            <input type="radio" name="style" value="v2" {$v2Checked}> Alternative style
            <br>
            <input type="submit" value="Change">
        </form>
HTML;
} else {
    $sidebar .= <<<HTML
        <a href="index.php?page=login">Sign in</a>
HTML;
}

$contents = '';