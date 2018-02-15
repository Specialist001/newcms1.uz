<?php
/**
 * Created by PhpStorm.
 * User: Home-44
 * Date: 16.02.2018
 * Time: 0:11
 */

namespace Engine\Service\Router;

use Engine\Service\AbstractProvider;
use Engine\Core\Router\Router;

class Provider extends AbstractProvider
{
    /**
     * @var string
     */
    public $serviceName = 'router';

    /**
     * @return mixed
     */
    public function init()
    {
        // TODO: Implement init() method.
        //It's for capture P2P
        //and for capture GitHub
        //it's from UTM

        $router = new Router('http://newcms1.uz/');
        $this->di->set($this->serviceName, $router);
    }
}
