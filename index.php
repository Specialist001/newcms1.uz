<?php
ini_set("display_errors", 1);
error_reporting(E_ALL);

//define('ROOT_DIR', __DIR__);

define('ENV', 'Cms');
//define('DS', DIRECTORY_SEPARATOR);

if (!is_file($_SERVER['DOCUMENT_ROOT'] . '/config/database.php')) {
    header('Location: /install');
    exit;
}

require_once 'engine/bootstrap.php';