<?php

if (!empty($_POST)) {
    $keys = array_flip(['text1', 'text2']);
    $data = array_intersect_key($_POST, $keys);
    $data = array_filter($data);

    if (count($data) < 2) {
        echo 'Not enough input data. Please, fill both texareas.';
        exit;
    }

    $result = getCommonWords(
        $data['text1'],
        $data['text2']
    );
    var_dump($result);
}

function getCommonWords($a, $b)
{
    $aWords = explode(' ', $a);
    $bWords = explode(' ', $b);

    return array_intersect($aWords, $bWords);
}