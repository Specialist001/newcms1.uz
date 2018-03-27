<?php

namespace Engine\Helper;

class HelperDI
{
    public static function get()
    {
        global $di;

        return $di;
    }
}