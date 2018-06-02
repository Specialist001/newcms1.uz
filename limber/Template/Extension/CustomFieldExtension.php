<?php
namespace Limber\Template\Extension;

use Twig_Extension;
use Twig_SimpleFunction;

class CustomFieldExtension extends Twig_Extension
{
    public function getName()
    {
        return 'TwigCustomFieldExtensions';
    }

    public function getFunctions()
    {
        return [
            new Twig_SimpleFunction('field', array($this, 'getValueField'))
        ];
    }

    public function getValueField(int $id, string $name)
    {
        return \Field::get($id, $name);
    }
}