<?php

require_once __DIR__ . '/../vendor/autoload.php';
//require_once __DIR__ . '/function.php';

if (version_compare($ver = PHP_VERSION, $req = LIMBER_PHP_MIN, '<')) {
    die(sprintf('You are running PHP %s, but Flexi needs at least PHP %s to run.', $ver, $req));
}

class_alias('Engine\\Core\\Template\\Asset', 'Asset');
class_alias('Engine\\Core\\Template\\Theme', 'Theme');
class_alias('Engine\\Core\\Template\\Setting', 'Setting');
class_alias('Engine\\Core\\Template\\Menu', 'Menu');
class_alias('Engine\\Core\\Customize\\Customize', 'Customize');
class_alias('Engine\\Helper\\Lang', 'Lang');

use Engine\Cms;
use Engine\DI\DI;

try{
    $di = new DI();

    $services = require __DIR__ . '/Config/Service.php';

    foreach ($services as $service){
        $provider = new $service($di);
        $provider->init();
    }

    $di->set('model', []);

    $cms = new Cms($di);
    $cms->run();

} catch (\ErrorException $e){
    echo $e->getMessage();
}