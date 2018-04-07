<?php
namespace Engine;

use Engine\Core\Database\Connection;
use Engine\DI\DI;

abstract class Service
{
    protected $di;

    protected $db;

    protected $load;

    protected $model;

    public function __construct(DI $di)
    {
        $this->di    = $di;
        $this->db    = $this->di->get('db');
        $this->load  = $this->di->get('load');
        $this->model = $this->di->get('model');
    }

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
    public function getLoad()
    {
        return $this->load;
    }

    /**
     * @return mixed
     */
    public function getModel($name)
    {
        $this->load->model(ucfirst($name), false, 'Admin');

        $model = $this->getDI()->get('model');

        return $model->{lcfirst($name)};
    }
}