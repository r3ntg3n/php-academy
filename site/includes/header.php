<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $pageTitle ?></title>
    <link rel="stylesheet" href="css/styles.css">
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