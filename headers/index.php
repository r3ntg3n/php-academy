<?php

//var_dump($_COOKIE);
$pageVisited = !empty($_COOKIE['pageVisited']);

$counter = file_get_contents('counter.txt');
$counter = intval($counter);

if (!$pageVisited) {

    setcookie(
        'pageVisited', // имя
        true, // значение
        time() + 3600 * 24, // время жизни
        '/', // путь, по которому будет доступ
    );
    $counter++;
    file_put_contents('counter.txt', $counter);
}
echo 'This page has been visited by ' . $counter . ' visitors';
?>