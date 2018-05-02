<?php
namespace Limber\Cms\Front\Classes;

use Limber;

class Page
{
    /**
     * @var Flexi\Cms\Front\Model\Page
     */
    protected static $page;

    /**
     * @param Flexi\Cms\Front\Model\Page $page
     */
    public static function setPage(Limber\Cms\Front\Model\Page $page)
    {
        static::$page = $page;
    }

    /**
     * @return Flexi\Cms\Front\Model\Page
     */
    public static function getPage()
    {
        return static::$page;
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