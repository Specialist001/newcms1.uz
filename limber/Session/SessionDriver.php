<?php
namespace Limber\Session;

class SessionDriver
{
    protected $key = 'limber';

    public function key(): string
    {
        return $this->key;
    }
}