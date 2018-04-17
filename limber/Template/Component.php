<?php
namespace Limber\Template;

use Limber\Routing\Router;
use Exception;

class Component
{
    public static function get(string $name, array $data = []): string
    {
        $data = array_merge_recursive(Layout::data(), $data);

        $path = View::pathTheme() . $name .'.php';

        return static::load($path, $data);
    }

    public static function load(string $path, array $data = []): string
    {
        extract($data);

        if (is_file($path)) {
            // Load component into a variable.
            ob_start();
            include $path;
            $component = ob_get_clean();

            return $component;
        } else {
            throw new Exception(
                sprintf('View file <strong>%s</strong> does not exist!', $path)
            );
        }
    }
}