<?php
namespace Limber\Mokko;

abstract class AbstractEngine
{
    protected $left;

    protected $right;

    public function __construct($left = '{{', $right = '}}')
    {
        $this->left = $left;
        $this->right = $right;
    }

    abstract public function render($template, $value);
}