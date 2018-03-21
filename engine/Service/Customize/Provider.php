<?php

namespace Engine\Service\Customize;

use Engine\Core\Customize\Customize;
use Engine\Service\AbstractProvider;

class Provider extends AbstractProvider
{
    public $serviceName = 'customize';

    /**
     * @return $mixed
     */
    public function init()
    {
        $customize = new Customize($this->di);

        $this->di->set($this->serviceName, $customize);

        return $this;
    }
}