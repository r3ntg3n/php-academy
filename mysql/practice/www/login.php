<?php

require '../config/bootstrap.php';

if (empty($_POST)) {
    header('Location: /index.php');
    exit;
}

$login = $_POST['login'];
$userPassword = $_POST['password'];
$query = 'SELECT id, password_hash
    FROM user
    WHERE login = :login && status = 1';
$statement = $db->prepare($query);
$statement->bindParam(':login', $login);
$statement->execute();

if (!$statement->rowCount()) {
    $_SESSION['loginError'] = 'Unknown username.';
}

$row = $statement->fetch(PDO::FETCH_ASSOC);
if (!password_verify($userPassword, $row['password_hash'])) {
    $_SESSION['loginError'] = 'Incorrect password.';   
} else {
    unset($_SESSION['loginError']);
    $authToken = generateAuthToken($row['id']);
    $cookieLifetime = time() + 3600;
    setcookie('auth', $authToken, $cookieLifetime);
    setUserAuthToken($row['id'], $authToken);
}

header('Location: /index.php');
