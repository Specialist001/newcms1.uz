<?php
namespace Modules\Front\Controller;

use Controller;
use Modules\Front\Classes\Resource;

class FrontController extends Controller
{
    //public $layout = 'main';

    public function __construct()
    {
        $this->loadThemeFunctions();

        $resourceModel = new \Modules\Admin\Model\ResourceType();
        $resourceTypes = $resourceModel->getResourcesType();

        foreach ($resourceTypes as $resourceType) {
            $this->setData($resourceType->getAttribute('name'), new Resource($resourceType->getAttribute('id')));
        }
    }

    private function loadThemeFunctions()
    {
        $functions = \View::pathTemplates() . 'functions.php';

        if (is_file($functions)) {
            require_once $functions;
        }
    }

    public function isController(string $name)
    {
        return "Modules\\Front\\Controller\\{$name}Controller" === $this->getNameController();
    }
}