<?php

namespace Engine\Service\Config;

use Engine\Service\AbstractProvider;
use Engine\Core\Config\Config;

class Provider extends AbstractProvider
 {
    /**
     * @var string
     */
    public $serviceName = 'config';

    /**
     * @return mixed
     */
    public function init()
    {
        $config['main.php']     = Config::file('main.php');
        $config['database'] = Config::file('database');

        $this->di->set($this->serviceName, $config);
    }
}
