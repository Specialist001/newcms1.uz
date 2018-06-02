<?php
namespace Limber\Template\Extension;

use Limber;
use Twig_Extension;
use Twig_SimpleFunction;

class HelperExtension extends Twig_Extension
{
    public function getName()
    {
        return 'TwigHelperExtensions';
    }

    public function getFunctions()
    {
        return [
            new Twig_SimpleFunction('uniqid', array($this, 'getUniqid'))
        ];
    }

    public function getUniqid()
    {
        return uniqid();
    }
}