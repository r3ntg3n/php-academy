<?php

define('ROOT_PATH', realpath(__DIR__ . '/..'));
session_start();

$user = new stdClass;

require 'database.php';
require 'functions.php';
