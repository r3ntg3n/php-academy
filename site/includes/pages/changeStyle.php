<?php


if (!empty($_POST['style'])) {
    $_SESSION['style'] = $_POST['style'];
}
header('Location: index.php');
exit;
