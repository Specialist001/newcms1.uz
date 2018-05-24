<?php
namespace Limber\Template;

use Limber;
use Limber\Routing\ResponderInterface;
use Limber\Routing\Router;
use Twig_Environment;
use Twig_Function;
use Twig_Loader_Filesystem;

class View implements ResponderInterface
{
    protected $file = '';

    protected $data = [];

    protected $pathTemplates = '';

    protected $twig;

    public function __construct()
    {
        $this->pathTemplates = $this->pathTemplates();

        //$_SERVER['DOCUMENT_ROOT'] . '/content/themes/default';
        $loader = new Twig_Loader_Filesystem($this->pathTemplates);
        $this->twig = new Twig_Environment($loader);

        $functions[] = new Twig_Function('__', function ($key, $data = []) {
            echo Limber\Localization\I18n::instance()->get($key, $data);
        });

        $functions[] = new Twig_Function('asset', function ($file) {
            echo Asset::get($file);
        });

        $functions[] = new Twig_Function('get_setting', function ($key, $section = 'general') {
            return \Setting::value($key, $section);
        });

        $functions[] = new Twig_Function('uniqid', function () {
            return uniqid();
        });

        foreach ($functions as $function) {
            $this->twig->addFunction($function);
        }
    }

    public function data(): array
    {
        return $this->data;
    }

    public static function pathTemplates(): string
    {
        return Router::module()->viewPath;
    }

    public function respond()
    {
        echo $this->render();
    }

    public function render(): string
    {
        $template = $this->twig->load($this->file . '.twig');

        return $template->render($this->data);
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