<?php
namespace Engine;

use Engine\Core\Database\Connection;
use Engine\Core\Router\Router;
use Engine\DI\DI;

abstract class Plugin
{
    protected $di;

    protected $db;

    protected $router;

    public function __construct(DI $di)
    {
        $this->di        = $di;
        $this->db        = $this->di->get('db');
        $this->router    = $this->di->get('router');
        $this->customize = $this->di->get('customize');
    }

    abstract public function details();

    /**
     * @return DI
     */
    public function getDI()
    {
        return $this->di;
    }

    /**
     * @return mixed
     */
    public function getDb()
    {
        return $this->db;
    }

    /**
     * @return mixed
     */
    public function getRouter()
    {
        return $this->router;
    }
}