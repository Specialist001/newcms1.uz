<?php
/**
 * Created by PhpStorm.
 * User: Bobur
 * Date: 12.02.2018
 * Time: 13:56
 */

namespace Engine;

use Engine\DI\DI;

class Cms
{
    /**
     * @var DI
     */
    private $di;
    public $router;

    /**
     * Cms constructor.
     * @param $di
     */
    public function __construct($di)
    {
        $this->di = $di;
        $this->router = $this->di->get('router');
    }

    /**
     * Run Cms
     */
    public function run(){
        //$db = $this->di->get('test2');

        $this->router->add('home', '/', 'HomeController:index');
        print_r($this->di);
    }


}