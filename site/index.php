<?php


require 'includes/common.php';
$page = !empty($_GET['page']) ? $_GET['page'] : null;
if (!empty($page)) {
    if (!isPageExists($page)) {
        header('Not Found', true, 404);
        exit;
    }

    if ($page != 'login'
        && !isUserAuthorized()
    ) {
        header('Location: index.php?page=login');
        exit;
    }
}

$page = is_null($page) ? 'index' : $page;
echo renderPage($page);
