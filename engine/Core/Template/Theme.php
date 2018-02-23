<?php

namespace Engine\Core\Template;


class Theme
{
    const RULES_NAME_FILE = [
        'header' => 'header-%s.php',
        'footer' => 'footer-%s.php',
        'sidebar' => 'sidebar-%s.php',
    ];

    /**
     * @type string
     */
    public $url = '';

    /**
     * @param null $name
     * @throws \Exception
     */
    public function header($name = null){
        $name = (string) $name;

        if($name !== ''){
            $name = sprintf(self::RULES_NAME_FILE['header'], $name);
        }

        $this->loadTemplateFile($name);
    }

    public function footer($name = ''){

    }

    public function sidebar($name = ''){

    }

    public function block($name = '', $data = []){

    }

    /**
     * @param $nameFile
     * @param array $data
     * @throws \Exception
     */
    private function loadTemplateFile($nameFile, $data = []){
        $templateFfile = ROOT_DIR . '/content/themes/default/' . $nameFile . '.php';

        if(is_file($templateFfile)){
            extract($data);
            require_once $templateFfile;
        }
        else{
            throw new \Exception(
                sprintf('View file %s does not exist!', $templateFfile)
            );
        }
    }

}