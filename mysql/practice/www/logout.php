<?php

require '../config/bootstrap.php';

if (!isUserAuthorized()) {
    header('Location: /index.php');
    exit;
}

$token = $_COOKIE['auth'];
$query = 'UPDATE user
    SET auth_token = NULL WHERE auth_token = :auth';
$st = $db->prepare($query);
$st->bindParam(':auth', $token, PDO::PARAM_STR);
$st->execute();
setcookie('auth', null, time() - 10);
header('Location: /index.php');
exit;