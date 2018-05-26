<?php
namespace Limber\Routing;

use Exception;
use Limber\Config\Config;

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

    public $viewPath = '';

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
        return path('modules') . DIRECTORY_SEPARATOR . $this->module . DIRECTORY_SEPARATOR;
    }

    public function url()
    {
        return Config::item('baseUrl') . DIRECTORY_SEPARATOR . 'modules' . DIRECTORY_SEPARATOR . $this->module . DIRECTORY_SEPARATOR;
    }

    public static function getUrlByName($name)
    {
        return Config::item('baseUrl') . DIRECTORY_SEPARATOR . 'modules' . DIRECTORY_SEPARATOR . $name . DIRECTORY_SEPARATOR;
    }

    public function pathView(): string
    {
        return $this->path() . 'View' . DIRECTORY_SEPARATOR;
    }

    public function pathTheme(): string
    {
        $theme = \Setting::value('active_theme', 'theme');

        if ($theme == '') {
            $theme = Config::item('defaultTheme');
        }

        return path_content('themes') . DIRECTORY_SEPARATOR . $theme . DIRECTORY_SEPARATOR;
    }

    public function urlTheme(): string
    {
        $theme = \Setting::value('active_theme', 'theme');

        if ($theme == '') {
            $theme = Config::item('defaultTheme');
        }

        return Config::item('baseUrl') . DIRECTORY_SEPARATOR . 'content' . DIRECTORY_SEPARATOR . 'themes' .  DIRECTORY_SEPARATOR . $theme . DIRECTORY_SEPARATOR;
    }

    public function run()
    {
        $class = '\\Modules\\' . $this->module . '\\Controller\\' . $this->controller;

        if (class_exists($class)) {
            $this->instance = new $class;

            $parents = class_parents($this->instance);

            if (in_array('Modules\Front\Controller\FrontController', $parents)) {
                $this->viewPath = $this->pathTheme();
            } else {
                $this->viewPath = $this->pathView();
            }

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
        $path = path('modules') . $this->module . DIRECTORY_SEPARATOR . 'module.php';
        $module = null;

        if (is_file($path)) {
            $module = require_once $path;
        }

        return $module;
    }
}