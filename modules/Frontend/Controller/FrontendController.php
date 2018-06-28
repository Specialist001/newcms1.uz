<?php
namespace Modules\Frontend\Controller;

use Controller;
use Limber\Config\Config;
use Modules\Frontend\Classes\Resource;

class FrontendController extends Controller
{
    //public $layout = 'main';

    public function __construct()
    {
        $this->loadThemeFunctions();

        $resourceModel = new \Modules\Backend\Model\ResourceType();
        $resourceTypes = $resourceModel->getResourcesType();

        foreach ($resourceTypes as $resourceType) {
            $this->setData($resourceType->getAttribute('name'), new Resource($resourceType->getAttribute('id')));
        }
    }

    private function loadThemeFunctions()
    {
        $theme = \Setting::value('active_theme', 'theme');
        if ($theme == '') {
            $theme = Config::item('defaultTheme');
        }
        $path = path_content('themes') . DIRECTORY_SEPARATOR . $theme . DIRECTORY_SEPARATOR . 'functions';
        foreach (scandir($path) as $file) {
            if ($file === '.' || $file === '..') continue;
            if (is_file($path . DIRECTORY_SEPARATOR . $file)) {
                require_once $path . DIRECTORY_SEPARATOR . $file;
            }
        }
    }

    public function isController(string $name)
    {
        return "Modules\\Frontend\\Controller\\{$name}Controller" === $this->getNameController();
    }
}