<?php

require '../config/bootstrap.php';

$page = isUserAuthorized() ? 'index' : 'login';
render($page);
