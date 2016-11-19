<?php

require '../config/bootstrap.php';

$validationErrors = [];
$formPreservedInputs = ['login', 'email', 'firstName', 'lastName'];
$formValues = array_fill_keys($formPreservedInputs, '');

if (!empty($_POST)) {
    $account = !empty($_POST['Account']) ? $_POST['Account'] : [];
    $profile = !empty($_POST['Profile']) ? $_POST['Profile'] : [];

    $requiredFields = [
        'login' => 'Pick a username.',
        'password' => 'Input your password.',
        'passwordConfirm' => 'Confirm your password.',
        'email' => 'Input your email address, please.',
    ];

    foreach ($requiredFields as $field => $errorMessage) {
        if (empty($account[$field])) {
            $validationErrors[$field] = $errorMessage;
        } else {
            $formValues[$field] = $account[$field];
        }
    }

    $profile = array_filter($profile);
    $formValues = array_merge($formValues, $profile);
    if (empty($validationErrors)) {
        if (isUserExists($account['login'])) {
            $validationErrors['login'] = 'Such username is already exists.';
        }

        if ($account['password'] !== $account['passwordConfirm']) {
            $validationErrors['passwordConfirm'] = 'Passwords don\'t match.';
        }

        if (!filter_var($account['email'], FILTER_VALIDATE_EMAIL)) {
            $validationErrors['email'] = 'Email does not look like valid.';
        }
    }

    if (empty($validationErrors)) {
        $passwordHash = password_hash(
            $account['password'],
            PASSWORD_DEFAULT,
            ['cost' => 13]
        );
        $queries = [
            [
                'query' => 'INSERT INTO user
                    (login, password_hash, email) VALUES
                    (:login, :passwordHash, :email)',
                'params' => [
                    ':login' => $account['login'],
                    ':passwordHash' => $passwordHash,
                    ':email' => $account['email'],
                ],
            ],
        ];

        if (!empty($profile)) {
            $profile = array_replace([
                'firstName' => '',
                'lastName' => '',
            ], $profile);
            $queries[] = [
                'query' => 'INSERT INTO profile
                    (user_id, first_name, last_name) VALUES
                    (:userId, :firstName, :lastName)',
                'params' => [
                    ':userId' => '@lastInsertId',
                    ':firstName' => $profile['firstName'],
                    ':lastName' => $profile['lastName'],
                ],
            ];
        }

        $db->beginTransaction();
        foreach ($queries as $data) {
            $st = $db->prepare($data['query']);
            foreach ($data['params'] as $placeholder => $value) {
                $value = ($value == '@lastInsertId')
                    ? $db->lastInsertId()
                    : $value;

                $st->bindValue($placeholder, $value, PDO::PARAM_STR);
            }

            try {
                $success = $st->execute();
            } catch (PDOException $e) {
                $db->rollBack();
                $validationErrors['generic'] = $e->getMessage();
            }

            if (!$success) {
                $db->rollBack();
            }
        }

        if ($success) {
            $db->commit();
            header('Location: /index.php');
            exit;
        }
    }
}

render('signup', [
    'validationErrors' => $validationErrors,
    'formValues' => $formValues,
]);
