<?php

$username = 'j.doe';
$password = 's3cr3t';
$token = base64_encode("{$username}:{$password}");

$handler = curl_init();
$options = [
    CURLOPT_URL => 'http://tests.loc/academy/site/administration/',
    CURLOPT_HTTPHEADER => ['Authorization: Basic ' . $token],
    CURLOPT_RETURNTRANSFER => true,
];
curl_setopt_array($handler, $options);
$result = curl_exec($handler);
curl_close($handler);
echo $result . PHP_EOL;
