<?php
namespace Engine\Service\Plugin;

use Engine\Service\AbstractProvider;
use Engine\Core\Plugin\Plugin;

class Provider extends AbstractProvider
{
    public $serviceName = 'plugin';

    public function init()
    {
        $plugin = new Provider($this->di);

        $this->di->set($this->serviceName, $plugin);

        return $this;
    }
}