<?php

require '../config/bootstrap.php';

if (!isUserAuthorized()
    || empty($user->superuser)
) {
    header('HTTP/1.0 403 Forbidden');
    exit;
}

$query = 'SELECT u.*, p.first_name, p.last_name
    FROM user u
    LEFT JOIN profile p ON u.id = p.user_id
    ORDER BY u.id';
$st = $db->query($query);

$users = $st->fetchAll(PDO::FETCH_ASSOC);
render('userManagement', ['users' => $users]);
