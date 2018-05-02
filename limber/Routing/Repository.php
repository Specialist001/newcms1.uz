<?php
namespace Limber\Routing;


class Repository
{
    protected static $stored = [
        'get'  => [],
        'post' => []
    ];

    public static function stored(): array
    {
        return static::$stored;
    }

    public static function store(string $method, string $uri, array $options)
    {
        static::$stored[$method][$uri] = $options;
    }

    public static function retrieve(string $method, string $uri): array
    {
        if (strpos($uri, '?')) {
            $uri = Route::prefixed(stristr($uri, '?', true));;
        }

        return static::$stored[$method][$uri] ?? [];
    }

    public static function remove(string $method, string $uri): bool
    {
        if (isset(static::$stored[$method][$uri])) {
            unset(static::$stored[$method][$uri]);
            return true;
        }

        return false;
    }
}