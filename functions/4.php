<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Task 4</title>
</head>
<body>
    <pre>

<?php
    
    function getDirectoryListing($dirName)
    {
        if (!is_dir($dirName)) {
            trigger_error('Directory does not exist.', E_USER_WARNING);
            return null;
        }

        chdir($dirName);

        $h = opendir('.');
        $files = [];
        while (($f = readdir($h)) !== false) {
            if ($f != '.'
                && $f != '..'
            ) {
                $files[] = $f;
            }
        }
        return $files;
    }


    $list = getDirectoryListing('.');
    print_r($list);
?>
</body>
</html>