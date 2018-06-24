<?php
declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';
define('ROOT_DIR', __DIR__);

if (!is_file(ROOT_DIR . '/config/database.php')) {
    \Limber\Http\Redirect::go('/install/');
}
$version_compare = version_compare($version = phpversion(), $required = \Limber\Define::PHP_MIN, '<');
if ($version_compare) {
    exit(sprintf('<h1 style="font-family: sans-serif;font-weight: 100;">You are running PHP %s, but Flexi needs at least PHP %s to run.</h1>', $version, $required));
}

try{
    \Limber\Routing\Router::initialize();
} catch (\ErrorException $e) {
    echo $e->getMessage();
}

