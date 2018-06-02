<?php
namespace Limber\Template\Extension;

use Twig_Extension;
use Twig_SimpleFunction;

class SettingExtension extends Twig_Extension
{
    public function getName()
    {
        return 'TwigSettingExtensions';
    }

    public function getFunctions()
    {
        return [
            new Twig_SimpleFunction('setting', array($this, 'getSettingValue'))
        ];
    }

    public function getSettingValue(string $key, string $section = 'general')
    {
        return \Setting::value($key, $section);
    }
}