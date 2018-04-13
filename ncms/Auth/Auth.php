<?php
namespace Ncms\Auth;

//use Engine\Core\Auth\AuthInterface;
use Ncms\Config\Config;
use Ncms\Encription\Hash;
use Ncms\Facades\Session;
use Ncms\Orm\Model;


class Auth implements AuthInterface
{
    protected static $authorized = false;

    protected static $user;

    public static function initialize() {
        $loaded = Config::group('auth');

        if (!$loaded) {
            exit('Unable to load auth config.');
        }

        if (Session::has('auth.user') && Session::has('auth.authorized')) {
            static::$authorized = Session::get('auth.authorized');
            static::$user       = Session::get('auth.user');
        }
    }

    public static function authorized(): bool
    {
        return static::$authorized;
    }

    public static function user(): Model
    {
        return static::$user;
    }

    public static function authorize(\Ncms\Orm\Model $user)
    {
        Session::put('auth.authorized', true);
        Session::put('auth.user', $user);

        static::$authorized = true;
        static::$user       = $user;
    }

    public static function unauthorize()
    {
        Session::forget('auth.authorized');
        Session::forget('auth.user');

        static::$authorized = false;
        static::$user       = null;
    }

    public static function usernameField(): string
    {
        return Config::item('username', 'auth');
    }

    public static function passwordField(): string
    {
        return Config::item('password', 'auth');
    }

    public static function salt(): string
    {
        return (string) rand(10000000, 99999999);
    }

    public static function encryptPassword(string $password, string $salt = ''): string
    {
        return Hash::make($password . $salt, 'md5');
    }
}