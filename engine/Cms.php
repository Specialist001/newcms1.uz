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

        $this->router->add('home', '/', 'HomeController:index');
        $this->router->add('news', '/news', 'HomeController:news');

        $routerDispatch = $this->router->dispatch(Common::getMethod(), Common::getPathUrl());

        list($class, $action) =  explode(':', $routerDispatch->getController(), 2);

        $controller = '\\Cms\\Controller\\' . $class;
        call_user_func_array([new $controller($this->di), $action], $routerDispatch->getParameters());

//        print_r($class);
//        echo '<br />';
//        print_r($action);
        //print_r($routerDispatch);

    }


}