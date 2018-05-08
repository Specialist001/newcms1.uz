<?php
namespace Limber\Routing;

use Exception;

class Module
{
    protected $instance;

    protected $response;

    public $module = '';

    public $controller = '';

    public $action = '';

    public $parameters = [];

    public $theme = '';

    public $current = [];

    public function __construct(array $config = [])
    {
        foreach ($config as $key => $value) {
            $this->$key = $value;
        }
        $this->current = $this->current();
        if (isset($this->current['theme'])) {
            $this->theme = $this->current['theme'];
        }
    }

    public function instance()
    {
        return $this->instance;
    }

    public function path(): string
    {
        return path('modules') . '/' . $this->module . '/';
    }

    public function run()
    {
        $class = '\\Modules\\' . $this->module . '\\Controller\\' . $this->controller;

        if (class_exists($class)) {
            $this->instance = new $class;
            $this->response = call_user_func_array([$this->instance, $this->action], $this->parameters);

            return $this->response;
        } else {
            throw new Exception(sprintf(
                'Controller %s does not exist.', $class)
            );
        }
    }

    public static function all(): array
    {
        $modules = [];

        foreach (scandir(path('modules')) as $module) {
            if ($module === '.' || $module === '..')    continue;

            if (is_file(path('modules') . 'module.php')) {
                array_push($modules, $module);
            }
        }

        return $modules;
    }

    public function current()
    {
        $path = path('modules') . $this->module . '/module.php';
        $module = null;

        if (is_file($path)) {
            $module = require_once $path;
        }

        return $module;
    }
}