<?php
/**
 * Created by PhpStorm.
 * User: Bobur
 * Date: 12.02.2018
 * Time: 13:56
 */

namespace Engine;

use Engine\DI\DI;
use Engine\Helper\Common;

class Cms
{
    /**
     * @var DI
     */
    private $di;
    public $router;

    /**
     * cms constructor.
     * @param $di
     */
    public function __construct($di)
    {
        $this->di = $di;
        $this->router = $this->di->get('router');
    }

    /**
     * Run cms
     */
    public function run(){
        //$db = $this->di->get('test2');
        $this->router->add('home', '/', 'HomeController:index');
        $this->router->add('product', '/user/{id}', 'ProductController:index');

        $routerDispatch = $this->router->dispatch(Common::getMethod(), Common::getPathUrl());
        //print_r($this->di);

        print_r($routerDispatch);
        //print Common::getPathUrl();
    }


}