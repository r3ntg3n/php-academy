<?php

function callMe()
{
    static $counter = 0;
    $counter++;

    return $counter;
}

callMe();
callMe();
callMe();
$count = callMe();
echo 'function callMe has been called ' . $count . ' times';

callMe();
$count = callMe();
echo 'function callMe has been called ' . $count . ' times';