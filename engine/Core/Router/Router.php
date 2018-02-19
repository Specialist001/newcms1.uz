<?php
/**
 * Created by PhpStorm.
 * User: Home-44
 * Date: 16.02.2018
 * Time: 0:02
 */

namespace Engine\Core\Router;


class Router
{
    private $routes = [];
    private $dispatcher;
    private $host;

    /**
     * Router constructor.
     * @param $host
     */
    public function __construct($host)
    {
        $this->host = $host;
    }

    /**
     * @param $key
     * @param $pattern
     * @param $controller
     * @param string $method
     */
    public function add($key, $pattern, $controller, $method = 'GET'){
        $this->routes[$key] = [
            'pattern'    => $pattern,
            'controller' => $controller,
            'method'     => $method
        ];
    }

    public function dispatch($method, $uri){

    }

    public function getDispatcher(){
        if($this->dispatcher == null){

        }

        return $this->dispatcher;
    }
}