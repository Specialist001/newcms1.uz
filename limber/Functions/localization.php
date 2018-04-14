<?php

function __($key)
{
    echo \Flexi\Localization\I18n::instance()->get($key);
}

function __e($key)
{
    return \Flexi\Localization\I18n::instance()->get($key);
}