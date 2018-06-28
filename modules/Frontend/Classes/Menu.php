<?php
namespace Modules\Frontend\Classes;

use Limber;

class Menu
{
    public static function getMenuItems(int $menuId)
    {
        $menuItems = Limber\DI\Container::instance()->get('menuItems');

        if ($menuItems !== null) {
            return $menuItems;
        }

        $menuModel = new Modules\Frontendend\Model\MenuItem;
        $menuItems = $menuModel->getItemsByMenuId($menuId);

        Limber\DI\Container::instance()->set('menuItems', $menuItems);

        return $menuItems;
    }
}