<?php
namespace Limber\Database\Migration;


class Column
{
    public $name = '';

    public $type = '';

    public $length = 0;

    public $default = '';

    public $nullable = false;

    public $autoincrement = false;

    public function __construct(array $config = [])
    {
        foreach ($config as $key => $value) {
            $this->$key = $value;
        }
    }

    public function nullable(): Column
    {
        $this->nullable = true;

        return $this;
    }
}