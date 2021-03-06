<?php

namespace Limber\DI;

class Container
{
    protected static $instance;

    /**
     * @var array
     */
    private $container = [];

    /**
     * @param $key
     * @return mixed
     */
    public function get($key)
    {
        return $this->has($key) ? $this->container[$key] : null;
    }

    /**
     * @param $key
     * @param $value
     * @return $this
     */
    public function set($key, $value)
    {
        $this->container[$key] = $value;

        return $this;
    }


    /**
     * @param $key
     * @return bool
     */
    public function has($key)
    {
        return isset($this->container[$key]);
    }

    public static function instance(): Container
    {
        if (self::$instance == null) {
            self::$instance = new Container();
        }
        return self::$instance;
    }
}

