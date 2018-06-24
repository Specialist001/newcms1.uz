<?php
namespace Limber\Template\Extension;

use Modules\Frontend\Classes\Menu;
use Twig_Extension;
use Twig_SimpleFunction;

class MenuExtension extends Twig_Extension
{
    public function getName()
    {
        return 'TwigMenuExtensions';
    }

    public function getFunctions()
    {
        return [
            new Twig_SimpleFunction('menu_items', array($this, 'getMenuItems'))
        ];
    }

    public function getMenuItems(int $menuId)
    {
        return Menu::getMenuItems($menuId);
    }
}