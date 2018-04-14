<?php
namespace Limber\Http;

class Input
{
    public static function get($key = false)
    {
        return $key ? static::getParam($key, $_GET) : $_GET;
    }

    public static function post($key = false)
    {
        return $key ? static::getParam($key, $_POST) : $_POST;
    }

    private static function getParam(string $key, array $array)
    {
        return $array[$key] ?? null;
    }
}