<?php

namespace Engine\Helper;

class Lang
{
    public static function e()
    {
        //$language = HelperDI::get()->get('language');
    }

    public static function _e($section, $key)
    {
        $language = HelperDI::get()->get('language');

        echo $language->{$section}[$key];
    }
}