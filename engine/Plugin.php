<?php

namespace Engine;

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

    //abstract public function init();
    abstract public function details();
    //abstract public function delete();

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