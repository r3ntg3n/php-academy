<?php
global $user;
$pageTitle = "Welcome, {$user->username}";
?>

<div class="row">
    <h1 class="page-header"><?= $pageTitle ?></h1>
</div>