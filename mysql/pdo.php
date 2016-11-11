<?php

// PDO

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

$username = 'Seth';
$passwordHash = 'TVASD123asc';
$email = 'seth@whitehouse.gov';
$active = '1as';
$query = 'INSERT INTO user (
        username, password_hash, email, active
    ) VALUES (:username, :hash, :email, :active)';

$statement = $db->prepare($query);
$statement->bindParam(':username', $username, PDO::PARAM_STR);
$statement->bindParam(':hash', $passwordHash, PDO::PARAM_STR);
$statement->bindValue(':email', $email, PDO::PARAM_STR);
$statement->bindValue(':active', $active, PDO::PARAM_INT);
//$statement->execute();

$query = 'SELECT
    username, email, first_name, last_name, active
    FROM user';

$statement = $db->query($query);

echo '<ul>';
while (($row = $statement->fetch(PDO::FETCH_ASSOC)) != null):
    $isActive = !empty($row['active']) ? 'Yes' : 'No';
?>
    <li>
        Username: <strong><?= $row['username'] ?></strong><br>
        Email: <a href="mailto:<?= $row['email'] ?>"><?= $row['email'] ?></a><br>
        Active: <?= $isActive ?><br>
    </li>
<?php
endwhile;
echo '</ul>';