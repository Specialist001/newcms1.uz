<?php
namespace Limber\Routing;

use Limber\Http\Request;
use Limber\Http\Uri;
use Limber\Limber;
use Limber\Template\View;

class Router
{
    protected static $module;

    public static function module(): \Limber\Routing\Module
    {
        return static::$module;
    }

    public static function initialize()
    {
        Limber::start();

        static::routes();

        $route = Repository::retrieve(Request::method(), Uri::segmentString());

        if (empty($route)) {
            exit('404');
        }

        static::$module = $module = new Module($route);

        \DI::instance()->set('module', static::$module);

        $response = $module->run();

        if (is_object($response) && method_exists($response, 'respond')) {
            $response->respond();
        }

        // Close Limber.
        Limber::close();
    }

    private static function routes()
    {
        foreach (scandir(path('modules')) as $module) {
            if (in_array($module, ['.', '..'], true)) continue;

            Route::$module = $module;

            if (is_file($path = path('modules') . DIRECTORY_SEPARATOR . $module . '/routes.php')) {
                require_once $path;
            }
        }

        static::rewrite();
    }

    private static function rewrite()
    {
        foreach (Repository::stored() as $method => $routes) {
            foreach ($routes as $uri => $options) {
                $segments = explode('/', $uri);
                $rewrite  = false;

                foreach ($segments as $key => $segment) {
                    $matches = [];

                    preg_match('/\(([0-9a-z]+)\:([a-z]+)\)/i', $segment, $matches);

                    if (!empty($matches)) {
                        $value = Uri::segment(($key + 1));
                        $rule  = $matches[2];
                        $valid = false;

                        if ($rule === 'numeric' && is_numeric($value)) {
                            $valid = true;
                        } else if($rule === 'any') {
                            $valid = true;
                        }

                        if ($valid === true) {
                            $segments[$key] = $value;
                        }

                        if (!isset($options['parameters'])) {
                            $options['parameters'] = [$value];
                        } else {
                            array_push($options['parameters'], $value);
                        }

                        $rewrite = true;
                    }
                }

                if ($rewrite) {
                    Repository::remove($method, $uri);

                    Repository::store($method, implode('/', $segments), $options);
                }
            }
        }
    }
}