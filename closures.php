<?php

$result = '';
$closure = function (array $drinks, $flavour = 'apple') use (&$result)
{
    $drink = implode(', ', $drinks);
    $result = implode(' ', [
        'Your',
        $drink,
        'with',
        $flavour,
        'has just been prepared.',
    ]);
};
$drinks = ['soda', 'juice'];
$closure(...[$drinks, 'orange']);
echo $result . '<br>';

$sql = 'UPDATE contacts SET ';
$attributes = [
    'name' => 'Ievgenii',
    'email' => 'i.dytyniuk@gmail.com',
];
array_walk($attributes, function($value, $column) use (&$sql) {
    $sql .= "`{$column}` = `{$value}`, ";
});
$sql = rtrim($sql, ', ') . ' WHERE id = 1';
echo $sql;