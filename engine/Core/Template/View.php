<?php

namespace Engine\Core\Template;

use Engine\Core\Template\Theme;

class View
{
    /**
     * @var \Engine\Core\Template\Theme
     */
    protected $theme;

    /**
     * View constructor.
     */
    public function __construct()
    {
        $this->theme = new Theme();
    }

    /**
     * @param $template
     * @param array $vars
     * @throws \Exception
     */
    public function render($template, $vars = []){
        //$templatePath = getTemplatePath($template, ENV);
        $templatePath = ROOT_DIR . '/content/themes/default/' . $template . '.php';

        if(!is_file(@$templatePath)){
            throw new \InvalidArgumentException(
                sprintf('Template "%s" not found in "%s" ', $template, $templatePath)
            );
        }

        $this->theme->setData($vars);
        extract($vars);

        ob_start();
        ob_implicit_flush(0);

        try{
            require $templatePath;
        }catch (\Exception $e){
            ob_end_clean();
            throw $e;
        }

        echo ob_get_clean();
    }

    /**
     * @param $template
     * @param null $env
     * @return string
     */
    private function getTemplatePath($template, $env = null){
        switch ($env){
            case 'Admin':
                return ROOT_DIR . '/admin/View/' . $template . '.php';
                break;
            case 'Cms':
                return ROOT_DIR . '/content/themes/default/' . $template . 'php';
                break;
            default:
                return ROOT_DIR . '/' . mb_strtolower($env) . '/View/' . $template . '.php';
        }
    }

}