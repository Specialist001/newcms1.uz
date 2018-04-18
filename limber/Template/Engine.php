<?php
namespace Limber\Template;

use Limber\Define;
use Limber\Routing\Router;
use Limber\Settings\Setting;

class Engine
{
    public $viewPath = '';

    public $viewUri = '';

    public function detectViewDirectory(): string
    {
        $module = Router::module();
        $theme = \Setting::value('active_theme', 'theme');

        $directory = sprintf('/content/themes/%s/', $theme);

        if ($module->module = Define::DEFAULT_MODULE['admin']) {
            $directory = '/limber/Cms/Admin/View/';
        }

        return $directory;
    }
}