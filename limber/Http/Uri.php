<?php
namespace Limber\Http;

class Uri
{
    protected static $base = '';

    protected static $uri = '';

    protected static $segments = [];

    public static function initialize()
    {
        // We need to get the different sections from the URI to process the
        // correct route.
        // Standard request in the browser?
        if (isset($_SERVER['REQUEST_URI'])) {

            // Get the active URI.
            $request    = $_SERVER['REQUEST_URI'];
            $host       = $_SERVER['HTTP_HOST'];
            $protocol   = 'http' . (Request::https() ? 's' : '');
            $base       = $protocol . '://' . $host;
            $uri        = $base . $request;

            // Build the URI segments.
            $length     = strlen($base);
            $str        = (string) substr($uri, $length);
            $arr        = (array) explode('/', trim($str, '/'));
            $segments   = [];
            foreach ($arr as $segment) {
                if ($segment !== '') {
                    array_push($segments, $segment);
                }
            }

            // Assign properties.
            static::$base       = $base;
            static::$uri        = $uri;
            static::$segments   = $segments;
        } else if (isset($_SERVER['argv'])) {
            $segments = [];
            foreach ($_SERVER['argv'] as $arg) {
                if ($arg !== $_SERVER['SCRIPT_NAME']) {
                    array_push($segments, $arg);
                }
            }
            static::$segments = $segments;
        }
    }

    public static function base(): string
    {
        return static::$base;
    }

    public static function uri(): string
    {
        return static::$uri;
    }

    public static function segments(): array
    {
        return static::$segments;
    }

    public function url(string $uri = ''): string
    {
        return static::base() . ltrim($uri, '/');
    }

    public static function segment(int $num): string
    {
        // Normalize the number.
        $num = $num - 1;

        // Attempt to find the segment.
        if (isset(static::$segments[$num])) {
            return static::$segments[$num];
        } else {
            return '';
        }
    }

    public static function segmentString(): string
    {
        return (string) implode('/', static::$segments);
    }


}