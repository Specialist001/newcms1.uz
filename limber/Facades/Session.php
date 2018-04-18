<?php
namespace Limber\Facades;

use Limber\Session\Session as Factory;
use Limber\Session\SessionDriver;
use Limber\Session\SessionInterface;

class Session
{
    protected static $session;

    public static function initialize()
    {
        return static::make();
    }

    public static function finalize(): bool
    {
        return static::make()->driver()->finalize();
    }

    public static function put(string $name, $data): SessionDriver
    {
        return static::make()->driver()->put($name, $data);
    }

    public static function get(string $name)
    {
        return static::make()->driver()->get($name);
    }

    public static function has(string $name): bool
    {
        return static::make()->driver()->has($name);
    }

    public static function forget(string $name): SessionDriver
    {
        return static::make()->driver()->forget($name);
    }

    public function flush(): SessionDriver
    {
        return static::make()->driver()->flush();
    }

    public function all(): array
    {
        return static::make()->driver()->all();
    }

    public function flash(string $name, $data = null)
    {
        return static::make()->driver()->flash($name, $data);
    }

    public function keep(string $name): SessionDriver
    {
        return static::make()->driver()->keep($name);
    }

    public function kept(): array
    {
        return static::make()->driver()->kept();
    }

    public static function make(): \Limber\Session\Session
    {
        return static::$session ?? new Factory;
    }
}