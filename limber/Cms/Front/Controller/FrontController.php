<?php
namespace Limber\Cms\Front\Controller;

use Controller;

class FrontController extends Controller
{
    public $layout = 'main';

    public function __construct()
    {
        $this->loadThemeFunctions();
    }

    private function loadThemeFunctions()
    {
        $functions = \View::path() . 'functions.php';

        if (is_file($functions)) {
            require_once $functions;
        }
    }

    public function isController(string $name)
    {
        return "Limber\\Cms\\Front\\Controller\\{$name}Controller" === $this->getNameController();
    }
}