<?php
namespace Cms\Classes;

class Page
{
    protected static $store;

    /**
     * @param $store
     */
    public static function setStore($store)
    {
        self::$store = $store;
    }

    /**
     * @return mixed
     */
    public static function getStore()
    {
        return self::$store;
    }

    public static function title()
    {
        echo static::$store->title;
    }

    public static function content()
    {
        echo static::$store->content;
    }


}