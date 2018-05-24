<?php
namespace Limber\Routing;

abstract class Controller
{
    public $theme = null;

    public $data = [];

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