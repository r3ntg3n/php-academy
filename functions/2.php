<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Task 2</title>
</head>
<body>
<?php
    $text = '';
    $words = [];
    if (!empty($_POST['text'])) {
        $text = $_POST['text'];
        $words = str_word_count($text, 1);
        
        usort($words, 'compareWords');
        $words = array_slice($words, 0, 3);
    }

    function compareWords($a, $b)
    {
        $lengthA = strlen($a);
        $lengthB = strlen($b);
        if ($lengthA == $lengthB) {
            return 0;
        }

        return ($lengthA > $lengthB) ? -1 : 1;
    }
?>
    <form action="" method="post">
        <textarea name="text" cols="30" rows="5"><?= $text ?></textarea>
        <br>
        <input type="submit" value="Send">
    </form>
    <pre>
    <?php print_r($words); ?>
    </pre>
</body>
</html>