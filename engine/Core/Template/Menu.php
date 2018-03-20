<?php

namespace Engine\Core\Template;

use Cms\Model\Menu\MenuRepository;
use Engine\DI\DI;
use Cms\Model\MenuItem\MenuItemRepository;


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

    public static function show()
    {

    }

    public static function getItems()
    {
        return self::$menuRepository->getList();
        //return self::$menuItemRepository->getItems();
    }
}