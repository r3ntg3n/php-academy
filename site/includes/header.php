<?php

$styleType = !empty($_SESSION['style'])
    ? $_SESSION['style']
    : '';

$styleSuffix = $styleType;
if (!empty($styleType)
    && $styleType == 'default'
) {
    $styleSuffix = '';
}
$stylesheetFilename = "styles{$styleSuffix}.css";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $pageTitle ?></title>
    <link rel="stylesheet" href="css/<?= $stylesheetFilename ?>">
</head>
<body>
    <header>
        <h1><?= $pageTitle ?></h1>
    </header>
    <aside>
        <?= !empty($sidebar) ? $sidebar : '' ?>
    </aside>
    <section>
    <?= $contents ?>
    </section>