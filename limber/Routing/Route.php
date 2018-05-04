<?php
namespace Limber\Routing;

use \Closure;

class Route
{
    private static $prefix = '';

    public static $module;

    public static function get(string $uri, array $options): bool
    {
        return static::add('get', $uri, $options);
    }

    public static function post(string $uri, array $options): bool
    {
        return static::add('post', $uri, $options);
    }

    public static function group(string $prefix, Closure $routes)
    {
        static::$prefix = $prefix;

        $routes();

        $prefix = '';
    }

    public static function add(string $method, string $uri, array $options): bool
    {
        if (static::validateOptions($options)) {
            if (!isset($options['module'])) $options['module'] = static::$module;

            Repository::store($method, static::prefixed($uri), $options);
            return true;
        }

        return false;
    }

    public static function prefixed(string $uri): string
    {
        $uri = trim($uri, '/');

        if (static::$prefix !== '') {
            $uri = trim(static::$prefix, '/') . '/' . $uri;
        }

        return $uri;
    }

    private static function validateOptions(array $options): bool
    {
        return isset($options['controller'], $options['action']);
    }
}