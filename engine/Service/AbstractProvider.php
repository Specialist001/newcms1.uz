<?php
/**
 * Created by PhpStorm.
 * User: Bobur
 * Date: 12.02.2018
 * Time: 15:52
 */

namespace Engine\Service;

class AbstractProvider
{
    /**
     * @var \Engine\DI\DI;
     */
    protected $di;

    /**
     * AbstractProvider constructor.
     * @param \Engine\DI\DI $di
     */
    public function __construct(\Engine\DI\DI $di)
    {
        $this->di = $di;
    }

    abstract function init();
}