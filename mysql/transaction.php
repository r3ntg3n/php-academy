<?php

$dbHost = 'localhost';
$dbUser = 'academy';
$dbPassword = 'acad3my';
$dbName = 'academy';

$dsn = "mysql:host={$dbHost};dbname={$dbName}";

try {
    $db = new PDO($dsn, $dbUser, $dbPassword);
} catch (PDOException $e) {
    echo 'Connection failed:<br><strong>'
    . $e->getCode() . '</strong> '
    . $e->getMessage();
}


$db->beginTransaction();
$query = 'SELECT MAX(id) + 1 as `next_id` FROM user';
$st = $db->query($query);
$row = $st->fetch(PDO::FETCH_ASSOC);
$userId = intval($row['next_id']);

$username = 'Ivan';
$password = '1v@n';
$email = 'ivan@balalayka.ru';
$firstName = 'Иван';
$lastName = 'Иваном';
$role = 'Newbye';
$fraction = 'Atas';

$query = 'INSERT INTO user (
    id, username, password_hash, email, first_name, last_name
) VALUES (
    :id, :login, :hash, :email, :firstName, :lastName
)';
$st = $db->prepare($query);
$paramMap = [
    ':id' => $userId,
    ':login' => $username,
    ':hash' => $password,
    ':email' => $email,
    ':firstName' => $firstName,
    ':lastName' => $lastName,
];
foreach ($paramMap as $param => $value) {
    $st->bindValue($param, $value, PDO::PARAM_STR);
}

$result = $st->execute();
var_dump($result);
if (!$result) {
    $db->rollback();
    exit('ERROR');
}

$query = 'INSERT INTO profile (user_id, role, fraction)
VALUES (:userId, :role, :fraction)';
$st = $db->prepare($query);
$st->bindParam(':role', $role, PDO::PARAM_STR);
$st->bindParam(':fraction', $fraction, PDO::PARAM_STR);
$st->bindParam(':userId', $userId, PDO::PARAM_INT);

$result = $st->execute();
var_dump($result);
if (!$result) {
    $db->rollBack();
    exit('ERROR');
}

$db->commit();
echo 'HOROSHO!';
