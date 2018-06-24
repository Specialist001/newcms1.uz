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

        $backendPath = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'modules/Backend/View/';
        $loader = new Twig_Loader_Filesystem($this->pathTemplates);
        $loader->addPath($backendPath, 'backend');

        $this->twig = new Twig_Environment($loader);

        $this->twig->addExtension(new Limber\Template\Extension\AssetExtension());
        $this->twig->addExtension(new Limber\Template\Extension\SettingExtension());
        $this->twig->addExtension(new Limber\Template\Extension\ResourceExtension());
        $this->twig->addExtension(new Limber\Template\Extension\LocalizationExtension());
        $this->twig->addExtension(new Limber\Template\Extension\HelperExtension());
        $this->twig->addExtension(new Limber\Template\Extension\FileExtension());
        $this->twig->addExtension(new Limber\Template\Extension\CustomFieldExtension());
        $this->twig->addExtension(new Limber\Template\Extension\MenuExtension());

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