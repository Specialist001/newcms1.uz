<?php

namespace Admin\Model\Setting;

use Engine\Core\Database\ActiveRecord;

class Setting
{
    use ActiveRecord;

    protected $table = 'setting';

    public $id;
    public $name;
    public $key_field;
    public $value;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * @return mixed
     */
    public function getKeyField()
    {
        return $this->key_field;
    }

    /**
     * @param mixed $key_field
     */
    public function setKeyField($key_field)
    {
        $this->key_field = $key_field;
    }

}