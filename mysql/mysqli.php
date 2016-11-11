<?php

// MySQLi

$dbHost = 'localhost';
$dbUser = 'academy';
$dbPassword = 'acad3my';
$dbName = 'academy';

$db = new MySQLi($dbHost, $dbUser, $dbPassword, $dbName);

$db = mysqli_connect($dbHost, $dbUser, $dbPassword, $dbName);
$result = mysqli_query($db, )
if ($db->connect_errno) {
    echo 'Cannot connection to database: '
        . $db->connect_errno . ' '
        . $db->connect_error;

}

//  $string = "'' */ asdzxc /&!@#";
//  $query = 'SELECT * FROM user WHERE id = ' . $string;
//  echo $query . '<br>';
//  $string = $db->real_escape_string($string);
//  $query = 'SELECT * FROM user WHERE id = ' . $string;
//  echo $query . '<br>';
//  exit;

$username = 'Sarah';
$passwordHash = '123vszu=wvxc';
$email = 'sarah@gmail.com';
$query = "INSERT INTO user (
        username, password_hash, email
    ) VALUES (?, ?, ?)";
$statement = $db->prepare($query);
$statement->bind_param('sss', $username, $passwordHash, $email);
$statement->execute();

$query = 'SELECT
    username, email, first_name, last_name, active
    FROM user';

$result = $db->query($query);

echo '<ul>';
while (($row = $result->fetch_assoc()) != null):
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