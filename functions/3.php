<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Task 3</title>
</head>
<body>
    <form action="" method="post">
        <input type="number" name="word_length">
        <br>
        <input type="submit" value="Send">
    </form>
    <pre>
<?php
    if (empty($_POST['word_length'])) {
        exit;
    }

    $maxLength = intval($_POST['word_length']);
    var_dump($maxLength);
    $file = '3.txt';
    $words = filterWorldsFromFile($file, $maxLength);
    saveIntoFile($file, $words);
    $words = filterWorldsFromFile($file, $maxLength);
    print_r($words);

    function filterWorldsFromFile($filename, $wordMaxLength)
    {
        $handler  = fopen($filename, 'r');
        $words = [];
        while (($line = fgets($handler)) !== false) {
            $words[] = $line;
        }

        fclose($handler);
        $words = array_filter(
            $words,
            function($item) use ($wordMaxLength) {
                $item = trim($item, "\n");
                return mb_strlen($item) <= $wordMaxLength;
            }
        );
        return $words;
    }

    function saveIntoFile($filename, array $lines)
    {
        $data = implode('', $lines);
        file_put_contents($filename, $data);
    }
?>
    </pre>
</body>
</html>