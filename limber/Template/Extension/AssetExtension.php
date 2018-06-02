<?php
namespace Limber\Template\Extension;

use Twig_Extension;
use Twig_SimpleFunction;

class AssetExtension extends Twig_Extension
{
    public function getName()
    {
        return 'TwigAssetExtensions';
    }

    public function getFunctions()
    {
        return [
            new Twig_SimpleFunction('asset', array($this, 'getAsset'))
        ];
    }

    public function getAsset(string $file)
    {
        return \Asset::get($file);
    }
}