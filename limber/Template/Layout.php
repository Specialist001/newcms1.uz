<?php
namespace Limber\Template;

use Limber;

class Layout
{
    protected static $data= [];

    protected static $view;

    public static function data(): array
    {
        return static::$data;
    }

    public static function set(string $key, $value)
    {
        static::$data[$key] = $value;
    }

    public static function get(string $name, array $data = []): string
    {
        // Merge the data.
        static::$data = array_merge_recursive(static::data(), $data);

        // Get the path to the layout.
        $path = View::path() . $name . '.layout' . View::TEMPLATE_EXTENSION;

        // Load.
        return Component::load($path, static::data());
    }

    public static function view(Limber\Template\View $view)
    {
        foreach ($view->data() as $key => $value) {
            static::set($key, $value);
        }
        static::$view = $view;
    }

    public static function content(): string
    {
        if (is_object(static::$view)) {
            return static::$view->render();
        } else {
            return '';
        }
    }
}