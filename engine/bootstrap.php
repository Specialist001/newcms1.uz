<?php
/**
 * Created by PhpStorm.
 * User: Bobur
 * Date: 12.02.2018
 * Time: 13:50
 */

require_once __DIR__ . '/../vendor/autoload.php';

use Engine\Cms;
use Engine\DI\DI;

try{
    $di = new DI();

    $services = require __DIR__ . '/Config/Service.php';

    foreach ($services as $service){
        $provider = new $service($di);
        $provider->init();
    }

    $cms = new Cms($di);
    $cms->run();

}catch (\ErrorException $e){
    echo $e->getMessage();

}