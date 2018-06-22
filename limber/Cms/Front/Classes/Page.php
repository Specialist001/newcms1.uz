<?php
namespace Limber\Cms\Front\Classes;

use Limber;

class Page
{
    /**
     * @var Limber\Cms\Front\Model\Page
     */
    protected static $page;

    /**
     * @param Limber\Cms\Front\Model\Page $page
     */
    public static function setPage(Limber\Cms\Front\Model\Page $page)
    {
        static::$page = $page;
    }

    /**
     * @return Limber\Cms\Front\Model\Page
     */
    public static function getPage()
    {
        return static::$page;
    }

    public static function getId()
    {
        return static::getPage()->getAttribute('id');
    }

    /**
     * Display page title.
     */
    public static function title()
    {
        echo static::getPage()->getAttribute('title');
    }

    /**
     * Display page content.
     */
    public static function content()
    {
        echo static::getPage()->getAttribute('content');
    }
}