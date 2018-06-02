<?php
namespace Limber\Template\Extension;

use Limber;
use Twig_Extension;
use Twig_SimpleFunction;

class LocalizationExtension extends Twig_Extension
{
    public function getName()
    {
        return 'TwigLocalizationExtensions';
    }

    public function getFunctions()
    {
        return [
            new Twig_SimpleFunction('__', array($this, 'getLang'))
        ];
    }

    public function getLang(string $key, array $data = [])
    {
        return Limber\Localization\I18n::instance()->get($key, $data);
    }
}