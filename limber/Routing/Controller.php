<?php
namespace Limber\Routing;

abstract class Controller
{
    public $layout = 'main';

    public $theme = null;

    public $data = [];

    public function setLayout(string $layout)
    {
        $this->layout = $layout;
    }

    /**
     * @param array $data
     */
    public function setData(string $key, $value)
    {
        $this->data[$key] = $value;
    }

    public function getNameController()
    {
        return get_called_class();
    }
}