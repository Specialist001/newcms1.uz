<?php

namespace Engine\Core\Template;

use Cms\Model\MenuItem\MenuItemRepository;
use Engine\DI\DI;
use Cms\Model\Menu\MenuRepository;


class Menu
{
    protected static $di;

    protected static $menuRepository;

    protected static $menuItemRepository;

    public function __construct($di)
    {
        self::$di = $di;
        self::$menuRepository = new MenuRepository(self::$di);
        self::$menuItemRepository = new MenuItemRepository(self::$di);
    }

    public static function getItems($menuId)
    {
        //return self::$menuRepository->getList();
        return self::$menuItemRepository->getItems($menuId);
    }
}