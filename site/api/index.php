<?php

header('Content-type: application/json');

$data = require 'repository.php';
$dataSize = count($data);
$pageSize = 5;
$page = !empty($_GET['page']) ? intval($_GET['page']) : 0;
if (!empty($page)) {
    $page--;
}

$offset = $page * $pageSize;
$response = array_slice($data, $offset, $pageSize);
if (!empty($response)) {
    $limit = $offset + $pageSize; // 0 + 5
    if ($limit > $dataSize) {
        $limit = $dataSize;
    }
    $offset++;

    header('Partial content', true, 206);
    header("Content-range: {$offset}-{$limit}/{$dataSize}");
} else {
    header('No Content', true, 204);
}
echo json_encode($response);