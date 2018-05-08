<?php
namespace Limber\Template;

use Limber\Define;
use Limber\Routing\Router;

class Engine
{
    public $viewPath = '';

    public $viewUri = '';

    public function detectViewDirectory(): string
    {
        $module = Router::module();

        $directory = sprintf('/modules/%s/View/', $module->module);

        return $directory;
    }

    public function detectThemeDirectory(): string
    {
        $module = Router::module();
        $theme = \Setting::value('active_theme', 'theme');

        if ($module->instance()->theme !== null) {
            $theme = $module->instance()->theme;
        }

        $directory = sprintf('/content/themes/%s/', $theme);
        return $directory;
    }
}