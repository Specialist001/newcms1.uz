<?php
namespace Limber\Template;

use Limber;
use Exception;

class Component
{
    public static $twig;

    public static function setTwig(\Twig_Environment $twig)
    {
        static::$twig = $twig;
    }

    public static function get($template, array $data = []): string
    {
        return $template->render($data);
    }

    public static function load(string $name): string
    {
        return static::$twig->load($name);
    }
}