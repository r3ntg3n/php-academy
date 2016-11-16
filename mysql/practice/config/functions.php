<?php

/**
 * Renders a view file from `/views/pages/` folder.
 *
 * @param string $page   View filename.
 * @param array  $params Set of variables to pass into the view.
 *
 * @return void
 */
function render($page, array $params = [])
{
    $__filename =  ROOT_PATH . "/views/pages/{$page}.php";
    if (!file_exists($__filename)) {
        trigger_error(
            "Cannot find view file <b>{$page}</b>",
            E_USER_ERROR
        );
    }

    foreach ($params as $name => $value) {
        $tmpName = "_{$name}";
        if (!empty($$name)) {
            $$tmpName = $$name;
        }

        $$name = $value;
    }

    ob_start();
    require $__filename;
    $__content = ob_get_contents();
    ob_clean();

    foreach ($params as $name => $value) {
        $tmpName = "_{$name}";
        if (!empty($$tmpName)) {
            $$name = $$tmpName;
        }
    }

    $content = $__content;
    require ROOT_PATH . '/views/index.php';
}

/**
 * Checks, whether user is authorized.
 *
 * @return boolean
 */
function isUserAuthorized()
{
    if (empty($_COOKIE['auth'])) {
        return false;
    }

    global $db;
    $token = $_COOKIE['auth'];
    $query = 'SELECT id, login FROM user WHERE auth_token = :auth';
    $st = $db->prepare($query);
    $st->bindParam(':auth', $token, PDO::PARAM_STR);
    $result = $st->execute();
    if ($row = $st->fetch(PDO::FETCH_ASSOC)) {
        global $user;
        $user->username = $row['login'];
        $user->id = intval($row['id']);
        return true;
    }

    return false;
}

/**
 * Generates authorization token for user.
 *
 * @param integer $userId User ID.
 *
 * @return string
 */
function generateAuthToken($userId)
{
    $userId = intval($userId);
    $authToken = uniqid('site_auth_', true);
    $authToken .= "^{$userId}";

    return $authToken;
}

function setUserAuthToken($userId, $token)
{
    $userId = intval($userId);
    if (empty($userId) || empty($token)) {
        trigger_error(
            'User ID or auth token cannot be blank',
            E_USER_ERROR
        );
    }

    global $db;
    $query = 'UPDATE user
        SET auth_token = :token WHERE id = :userId';
    $st = $db->prepare($query);
    $st->bindParam(':token', $token, PDO::PARAM_STR);
    $st->bindParam(':userId', $userId, PDO::PARAM_INT);
    $st->execute();
}