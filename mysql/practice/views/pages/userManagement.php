<?php

$pageTitle = 'Manage users';

?>
<div class="row">
    <div class="col-xs-12">
        <h1 class="page-header"><?= $pageTitle ?></h1>
    </div>
</div>
<div class="row">
    <div class="col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">List of users</h4>
            </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>E-mail</th>
                        <th>Active</th>
                        <th>First name</th>
                        <th>Last name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php if (empty($users)) { ?>
                    <tr>
                        <td colspan="6">No users found.</td>
                    </tr>
                <?php
                    } else {
                        foreach ($users as $record):
                ?>
                    <tr>
                        <td><?= $record['login'] ?></td>
                        <td><?= $record['email'] ?></td>
                        <td>
                            <?php if ($record['status']) {
                                $label = 'Active';
                                $labelClass = 'success';
                            } else {
                                $label = 'Inactive';
                                $labelClass = 'default';
                            } ?>
                            <span class="label label-<?= $labelClass ?>">
                                <?= $label ?>
                            </span>
                        </td>
                        <td><?= $record['first_name'] ?></td>
                        <td><?= $record['last_name'] ?></td>
                        <td>
                            <div class="btn-group btn-group-xs">
                                <a href="/editUser.php?id=<?= $record['id'] ?>" class="btn btn-default btn-xs">
                                    <i class="glyphicon glyphicon-pencil"></i>
                                    Edit
                                </a>
                                <a href="/changePassword.php?id=<?= $record['id'] ?>" class="btn btn-warning btn-xs">
                                    <i class="glyphicon glyphicon-lock"></i>
                                    Password
                                </a>
                                <a href="/disable.php?id=<?= $record['id'] ?>" class="btn btn-danger btn-xs">
                                    <i class="glyphicon glyphicon-remove"></i>
                                    Disable
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php
                        endforeach;
                    }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>