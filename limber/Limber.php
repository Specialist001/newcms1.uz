<?php
namespace Limber;

use Limber\Auth\Auth;
use Limber\Database\Database;
use Limber\Facades\Session;
use Limber\Http\Uri;

class Limber
{
    public static function start()
    {
        // Check aliases.
        class_alias('\\Limber\\Template\\Component', 'Component');
        class_alias('\\Limber\\Routing\\Controller', 'Controller');
        class_alias('\\Limber\\Template\\Layout', 'Layout');
        class_alias('\\Limber\\Orm\\Query', 'Query');
        class_alias('\\Limber\\Routing\\Route', 'Route');
        class_alias('\\Limber\\Template\\View', 'View');
        class_alias('\\Limber\\Template\\Asset', 'Asset');
        class_alias('\\Limber\\Settings\\Setting', 'Setting');
        class_alias('\\Limber\\Customize\\Customize', 'Customize');
        class_alias('\\Limber\\DI\\Container', 'DI');
        class_alias('\\Limber\\Cms\\Front\\Classes\\Page', 'Page');
        class_alias('\\Limber\\Cms\\Front\\Classes\\Field', 'Field');
        class_alias('\\Limber\\Cms\\Front\\Classes\\Post', 'Post');

        // Initialize the URI.
        Uri::initialize();

        // Attempt a database connection.
        Database::initialize();

        // Initialize the session.
        Session::initialize();

        // Initialize auth.
        Auth::initialize();
    }

    public static function close()
    {
        Database::finalize();
    }
}