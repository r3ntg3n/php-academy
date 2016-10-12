<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    
<table border="1" style="border-collapse: collapse;" cellpadding="5" cellspacing="0">
    <tbody>
<?php

for ($i = 1; $i < 10; $i++) {
    echo "<tr>";
    for ($j = 2; $j < 10; $j++) {
        $d = $i * $j;
        echo "<td>{$j} x {$i} = {$d}</td>" . PHP_EOL;
    }
    echo "</tr>";
}
?>
    </tbody>
</table>
</body>
</html>