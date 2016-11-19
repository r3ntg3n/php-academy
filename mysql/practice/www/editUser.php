<?php

require '../config/bootstrap.php';

if (!isUserAuthorized()
    || empty($user->superuser)
) {
    header('HTTP/1.0 403 Forbidden');
    exit;
}

$userId = !empty($_GET['id']) ? intval($_GET['id']) : null;
if (empty($userId)) {
    header('HTTP/1.0 400 Bad Request');
    exit;
}

$query = 'SELECT * FROM user WHERE id = :userId';
$st = $db->prepare($query);
$st->bindParam(':userId', $userId, PDO::PARAM_INT);
$st->execute();

if (!$st->rowCount()) {
    header('HTTP/1.0 404 Not Found');
    exit;
}

$userData = $st->fetch(PDO::FETCH_ASSOC);
$query = 'SELECT * FROM profile WHERE user_id = :userId';
$st = $db->prepare($query);
$st->bindParam(':userId', $userId, PDO::PARAM_INT);
$st->execute();

if ($st->rowCount()) {
    $profileData = $st->fetch(PDO::FETCH_ASSOC);
} else {
    $profileData = [
        'user_id' => $userId,
        'first_name' => '',
        'last_name' => '',
    ];
}

render('editUser', [
    'userData' => $userData,
    'profileData' => $profileData,
]);