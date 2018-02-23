<?php

namespace Engine\Core\Template;

class Theme
{
    const RULES_NAME_FILE = [
        'header' => 'header-%s',
        'footer' => 'footer-%s',
        'sidebar' => 'sidebar-%s',
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
        $file = 'header';

        if($name !== ''){
            $file = sprintf(self::RULES_NAME_FILE['header'], $name);
        }

        $this->loadTemplateFile($file);
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