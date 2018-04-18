<?php
ini_set("display_errors", 1);
error_reporting(E_ALL);

require_once __DIR__ . '/vendor/autoload.php';
define('ROOT_DIR', __DIR__);

if (!is_file(ROOT_DIR . '/config/database.php')) {
    \Limber\Http\Redirect::go('/install/');
}
$version_compare = version_compare($version = \Limber\Define::PHP_MIN, $required = \Limber\Define::PHP_MIN, '<');
if ($version_compare) {
    exit(sprintf('You are running PHP %s, but Limber needs at least PHP %s to run.', $version, $required));
}

try{
    \Limber\Routing\Router::initialize();
} catch (\ErrorException $e) {
    echo $e->getMessage();
}

