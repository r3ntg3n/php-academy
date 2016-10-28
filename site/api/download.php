<?php

$data = require 'repository.php';
$content = json_encode($data);
$date = date('YmdHi');
header('Content-type: application/json');
header("Content-disposition: attachment; filename=repository-{$date}.json");
header('Content-Length: ' . strlen($content));
echo $content;
