<?php
namespace Limber\Database;

use \PDO;
use \PDOException;
use Limber\Config\Config;
use Exception;

class Database
{
    protected static $connection;

    public static function connection()
    {
        return static::$connection;
    }

    public static function initialize()
    {
        static::$connection = static::connect();
    }

    public static function finalize()
    {
        // Close connection.
        static::$connection = null;
    }

    private static function connect()
    {
        $driver   = Config::item('driver', 'database');
        $host     = Config::item('host', 'database');
        $username = Config::item('username', 'database');
        $password = Config::item('password', 'database');
        $name     = Config::item('db_name', 'database');
        $dsn      = sprintf('%s:host=%s;dbname=%s', $driver, $host, $name);
        $options  = [
            PDO::ATTR_PERSISTENT => false,
            PDO::ATTR_ERRMODE    => PDO::ERRMODE_EXCEPTION
        ];

        if ($driver === '' || $username === '' || $name === '') {
            return null;
        }

        try {
            $connection = new PDO($dsn, $username, $password, $options);
        } catch (PDOException $error) {
            throw new Exception($error->getMessage());
        }

        return $connection ?? null;
    }

    public static function insertId(): int
    {
        return (int) static::$connection->lastInsertId();
    }
}