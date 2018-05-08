<?php
namespace Limber\Template;

use Limber\Routing\Router;
use Exception;

class Component
{
    public static function get(string $name, array $data = []): string
    {
        // Merge the data.
        $data = array_merge_recursive(Layout::data(), $data);

        // Get the component path.
        $path = View::path() . $name . View::TEMPLATE_EXTENSION;

        // Return the loaded component.
        return static::load($path, $data);
    }

    public static function load(string $path, array $data = []): string
    {
        // Ensure the data is available in the view as variables.
        extract($data);

        // Ensure the file exists.
        if (is_file($path)) {
            // Load component into a variable.
            ob_start();
            include $path;
            $component = ob_get_clean();

            // Return loaded component.
            return $component;
        } else {
            throw new Exception(
                sprintf('View file <strong>%s</strong> does not exist!', $path)
            );
        }
    }
}