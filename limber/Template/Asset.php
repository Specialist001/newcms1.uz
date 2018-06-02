<?php
namespace Limber\Template;

use Limber\Routing\Router;

class Asset
{
    public static $container = [];

    public static function get(string $file): string
    {
        if (Router::module()->module === 'Front') {
            return Router::module()->urlTheme() . $file;
        }

        return Router::module()->url() . 'View' . DIRECTORY_SEPARATOR . $file;
    }
}