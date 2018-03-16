<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/Function.php';

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

}catch (\ErrorException $e){
    echo $e->getMessage();
}