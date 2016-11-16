<?php

$db = getDatabaseConnection();

/**
 * Returns database connection.
 *
 * @return PDO
 */
function getDatabaseConnection()
{
    $dbHost = 'localhost';
    $dbUser = 'academy';
    $dbPassword = 'acad3my';
    $dbname = $dbUser;

    static $instance;

    if (empty($instance)) {
        $dsn = "mysql:host={$dbHost};dbname={$dbname}";
        $instance = new PDO($dsn, $dbUser, $dbPassword);
    }

    return $instance;
}
