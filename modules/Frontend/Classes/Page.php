<?php
namespace Modules\Frontend\Classes;

use Limber;

class Page
{
    /**
     * @var Flexi\Cms\Frontend\Model\Page
     */
    protected static $page;

    /**
     * @param Flexi\Cms\Frontend\Model\Page $page
     */
    public static function setPage(Modules\Frontend\Model\Page $page)
    {
        static::$page = $page;
    }

    /**
     * @return Flexi\Cms\Frontend\Model\Page
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