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
    $filename = ROOT_PATH . "/views/pages/{$page}.php";
    if (!file_exists($filename)) {
        trigger_error(
            "Cannot find view file <b>{$page}</b>",
            E_USER_ERROR
        );
    }

    $content = renderViewFile($filename, $params);
    require ROOT_PATH . '/views/index.php';
}

/**
 * Renders view file and returns render result.
 *
 * @param string $file   View filename.
 * @param array  $params Rendering parameters.
 *
 * @return mixed
 */
function renderViewFile($file, array $params = [])
{
    ob_start();
    ob_implicit_flush(false);
    extract($params, EXTR_OVERWRITE);
    require $file;
    $content = ob_get_contents();
    ob_clean();
    return $content;
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
    $query = 'SELECT id, login as username, superuser FROM user WHERE auth_token = :auth';
    $st = $db->prepare($query);
    $st->bindParam(':auth', $token, PDO::PARAM_STR);
    $result = $st->execute();
    if ($row = $st->fetch(PDO::FETCH_ASSOC)) {
        global $user;
        foreach ($row as $property => $value) {
            $user->{$property} = $value;
        }
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

/**
 * Checks, if username is already exists.
 *
 * @param string $username Username to check.
 *
 * @return boolean
 */
function isUserExists($username)
{
    global $db;
    $query = 'SELECT 1 FROM user WHERE login = :login';
    $st = $db->prepare($query);
    $st->bindParam(':login', $username, PDO::PARAM_STR);
    $st->execute();

    return !empty($st->rowCount());
}