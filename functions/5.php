<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Task 5</title>
</head>
<body>
    <pre>

<?php
    
    function getDirectoryListing($dirName, $searchTerm)
    {
        if (!is_dir($dirName)) {
            trigger_error('Directory does not exist.', E_USER_WARNING);
            return null;
        }

        chdir($dirName);
        return glob("*{$searchTerm}*");
    }


    $list = getDirectoryListing('.', 'php');
    print_r($list);
?>
</body>
</html>