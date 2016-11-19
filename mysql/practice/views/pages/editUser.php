<?php

$pageTitle = "Edit {$userData['login']}";

?>
<div class="row">
    <div class="col-xs-12">
        <h1 class="page-header">
            <?= $pageTitle ?>
            <a href="/management.php" class="btn btn-default pull-right">
                <i class="glyphicon glyphicon-chevron-left"></i>
                Back to the list
            </a>
        </h1>
    </div>
</div>
<div class="row">
    <div class="col-xs-12">
        <form action="/editUser.php?id=<?= $userData['id'] ?>" method="post">
            <input type="hidden" name="Account[id]" value="<?= $userData['id'] ?>">
            <div class="form-group">
                <label for="login">Username</label>
                <input type="text" name="Account[login]" id="login" required class="form-control" placeholder="Username" value="<?= $userData['login'] ?>">
            </div>
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" name="Account[email]" id="email" required placeholder="E-mail address" class="form-control" value="<?= $userData['email'] ?>">
            </div>
            <div class="form-group">
                <div class="checkbox">
                    <label>
                        <?php $checked = !empty($userData['status']) ? 'checked' : ''; ?>
                        <input type="checkbox" name="Account[status]" value="1" <?= $checked ?>>
                        Active
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label for="firstName">First name</label>
                <input type="text" name="Profile[firstName]" id="firstName" placeholder="First name" class="form-control" value="<?= $profileData['first_name'] ?>">
            </div>
            <div class="form-group">
                <label for="lastName">Last name</label>
                <input type="text" name="Profile[lastName]" id="lastName" placeholder="Last name" class="form-control" value="<?= $profileData['last_name'] ?>">
            </div>
            <div class="form-group">
                <button class="btn btn-primary">
                    <i class="glyphicon glyphicon-floppy-disk"></i>
                    Save
                </button>
            </div>
        </form>
    </div>
</div>