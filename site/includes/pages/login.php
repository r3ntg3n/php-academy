<?php

if (isUserAuthorized()) {
    header('Location: index.php');
    exit;
}

session_start();
$sessionId = session_id();

if (!empty($_POST)) {
    $requestId = getParamsFromRequest($_POST, 'requestToken');
    if ($requestId != $sessionId) {
        header('Location: index.php?page=login');
        exit;
    }

    $username = getParamsFromRequest($_POST, 'username');
    $password = getParamsFromRequest($_POST, 'password');

    if (!empty($username)
        && !empty($password)
        && authorizeUser($username, $password)
    ) {
        header('Location: index.php');
    } else {
        header('Location: index.php?page=login');
    }

    exit;
}

$pageTitle = 'Sign in';
$contents = <<<HTML
<p>Please, enter your username and password.</p>

<form action="" method="post">
    <input type="hidden" value="{$sessionId}" name="requestToken">
    <label>Username <span class="required">*</span></label>
    <input type="text" name="username" required>
    <br>
    <label>Password <span class="required">*</span></label>
    <input type="password" name="password" required>
    <br>
    <input type="submit" value="Sign in">
</form>

HTML;
