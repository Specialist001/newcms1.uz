<?php
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
        $this->router->add('product', '/user/12', 'ProductController:index');

        $routerDispatch = $this->router->dispatch(Common::getMethod(), Common::getPathUrl());
        //print_r($this->di);

        print_r($routerDispatch);
        //17:58   xato bo
        //print Common::getPathUrl();
    }


}