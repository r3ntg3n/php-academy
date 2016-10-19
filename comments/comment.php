<?php

/**
 * This is a handler for comments form.
 */

require 'common.php';

if (empty($_POST)) {
    redirect('index.php');
}

$body = !empty($_POST['comment']) ? $_POST['comment'] : null;
$username = !empty($_POST['username']) ? $_POST['username'] : null;
$email = !empty($_POST['email']) ? $_POST['email'] : null;
$date = date('Y-m-d H:i');

if (!$body || !$username || !$email) {
    redirect('index.php');
}

$body = processCommentBody($body);
$data = compact(['username', 'email', 'date', 'body']);
$storageData = prepareDataForStorage($data);
saveToFile($storageData);
redirect('index.php');

