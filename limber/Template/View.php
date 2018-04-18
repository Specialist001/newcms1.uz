<?php
namespace Limber\Template;

use Limber\Config\Config;
use Limber\Http\Uri;
use Limber\Routing\ResponderInterface;
use Limber\Routing\Router;

class View implements ResponderInterface
{
    protected $file = '';

    protected $data = [];

    protected static $engine;

    public function __construct()
    {
        static::$engine = new Engine();
    }

    public static function engine(): Engine
    {
        return static::$engine;
    }

    public function data(): array
    {
        return $this->data;
    }

    public static function theme(): string
    {
        return static::engine()->detectViewDirectory();
    }

    public static function path(): string
    {
        return ROOT_DIR . static::engine()->detectViewDirectory();;
    }

    public function respond()
    {
        // Get the module action instance.
        $instance = Router::module()->instance();

        // If we have no layout, then directly output the view.
        if (is_object($instance) && isset($instance->layout) && $instance->layout === '') {
            echo $this->render();
        } else {
            Layout::view($this);
        }
    }

    public function render(): string
    {
        // Get path for the views.
        $path = static::path() . $this->file . '.php';

        // Render the view.
        return Component::load($path, $this->data);
    }

    public static function make(string $file, array $data = []): View
    {
        // Instantiate class.
        $name           = get_called_class();
        $class          = new $name;
        $class->file    = $file;
        $class->data    = $data;

        // Return new object.
        return $class;
    }
}