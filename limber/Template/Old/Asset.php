<?php
namespace Limber\Template;

class Asset
{
    public static $container = [];

    public static function get($file): string
    {
        return View::theme() . $file;
    }
}