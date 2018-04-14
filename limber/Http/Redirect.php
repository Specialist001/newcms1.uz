<?php
namespace Limber\Http;

class Redirect
{
    public static function go(string $url, $permanent = false)
    {
        if ($permanent) {
            header('HTTP/1.1 301 Moved Permanently');
        }
        header('Location: ' . $url);
        exit();
    }
}