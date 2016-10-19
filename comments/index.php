<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Comments</title>
</head>
<body>
    <header>
        <h1>Comments</h1>
    </header>
    <section>
        <form action="comment.php" method="post">
            <label for="comment">Comment body</label><br>
            <textarea id="comment" name="comment" rows="8" cols="40" required="true"></textarea>
            <br><br>
            <label for="username">Username</label>
            <input type="text" name="username" id="username" required="true">
            <br><br>
            <label for="email">E-mail</label>
            <input type="email" name="email" id="email" required="true">
            <br><br>
            <input type="submit" value="Send">
        </form>
    </section>
    <section>
<?php
require 'common.php';

$comments = getComments();
if (!empty($comments)) {
    echo '<ol>';
    foreach ($comments as &$entry) :
?>
    <li>
        <?= $entry['date'] ?>&nbsp;/&nbsp; 
        <?= prepareOutput($entry['username']) ?>&nbsp;/&nbsp; 
        <?= prepareOutput($entry['email']) ?><br>
        <?= prepareOutput($entry['body']) ?><br>
        <br>
    </li>
<?php
    endforeach;
    unset($entry);
    echo '</ol>';
} else {
    echo "<h3>No comments have been added yet.</h3>";
}
?>        
    </section>
</body>
</html>