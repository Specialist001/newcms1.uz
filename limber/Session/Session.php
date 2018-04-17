<?php
namespace Limber\Session;

class Session
{
    protected static $initialized = false;

    protected static $driver;

    public function __construct()
    {
        if (!static::$initialized) {
            $driver = 'native';
            $class  = 'Limber\\Session\\Driver\\' . ucfirst(strtolower($driver));

            static::$driver = new $class;

            if (static::driver()->initialize()) {
                static::$initialized = true;
            }
        }
    }

    public function __destruct()
    {
        static::driver()->finalize();
    }

    public static function driver(): SessionInterface
    {
        return static::$driver;
    }
}