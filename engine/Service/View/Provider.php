<?php

namespace Engine\Service\View;

use Engine\Service\AbstractProvider;
use Engine\Core\Template\View;

class Provider extends AbstractProvider
{
    /**
     * @var string
     */
    public $serviceName = 'view';

    /**
     * @return mixed
     */
    public function init()
    {
        // TODO: Implement init() method.
        //It's for capture P2P
        //and for capture GitHub
        //it's from UTM

        $view = new View();

        $this->di->set($this->serviceName, $view);
    }
}
