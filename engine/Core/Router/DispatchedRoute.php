<?php
/**
 * Created by PhpStorm.
 * User: Bobur
 * Date: 19.02.2018
 * Time: 15:43
 */

namespace Engine\Core\Router;


class DispatchedRoute
{
    private $controller;
    private $parameters;

    public function __construct($controller, $parameters = [] )
    {
        $this->controller = $controller;
        $this->parameters = $parameters;
    }

    /**
     * @return mixed
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * @return array
     */
    public function getParameters()
    {
        return $this->parameters;
    }
}