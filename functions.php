<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>


<?php

static $staticVar = [];
$b = $staticVar;

$staticVar = 'PHP';
$a = $staticVar;

/**
 * [makeDrink description]
 * @param  array  $drinks  [description]
 * @param  string $flavour [description]
 * @return string
 */
function makeDrink(array $drinks, $flavour = 'apple')
{
    //var_dump($GLOBALS);
    /*
    var_dump(func_num_args());
    var_dump(func_get_args());
    var_dump(func_get_arg(0));
    */
   
    $drink = implode(', ', $drinks);
    return implode(' ', [
        'Your',
        $drink,
        'with',
        $flavour,
        'has just been prepared.',
    ]);
}
$drinks = ['soda', 'juice'];
$result = makeDrink(...[$drinks, 'orange']);
// call_user_func
// call_user_func_array
//echo $result . '<br>';

$error = null;
function safeCopy($source, $target, $overwrite = false)
{
    if (!is_file($source)
        || !is_readable($source)
    ) {
        $GLOBALS['error'] = 'Source file does not exist or cannot be read.';
        return false;
    }

    if (file_exists($target)
        && !$overwrite
    ) {
        $GLOBALS['error'] = 'Targer file is already exists.';
        return false;
    }

    return copy($source, $target);
}

//$result = safeCopy('123.php', '23.php', true);
function printMenu(array $menu, $upperLevel = '')
{
    static $levels = 0;
    $levels++;
    echo '<ul>';
    foreach ($menu as &$item) {
        $url = "{$upperLevel}{$item['url']}";
        echo "<li><a href=\"{$url}\">{$item['name']}</a></li>";
        if (!empty($item['items'])) {
            printMenu($item['items'], $url);
        }
    }
    unset($value);
    echo '(Printed level: ' . $levels . ')';
    echo '</ul>';
}

$menu =require 'menu.php';
printMenu($menu);












?>




</body>
</html>

