<?php
namespace Limber\Settings;

class Repository
{
    protected static $stored = [];

    public static function store($section, $data)
    {
        if (!isset(static::$stored[$section])) {
            static::$stored[$section] = [];
        }

        static::$stored[$section][$data->getAttribute('key_field')] = $data;
    }

    public static function retrieve($section, $key)
    {
        return isset(static::$stored[$section][$key]) ? static::$stored[$section][$key] : false;
    }

    public static function retrieveGroup($section)
    {
        return isset(static::$stored[$section]) ? static::$stored[$section] : false;
    }
}