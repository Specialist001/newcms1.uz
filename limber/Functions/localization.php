<?php

function __($key)
{
    echo \Limber\Localization\I18n::instance()->get($key);
}

function __e($key)
{
    return \Limber\Localization\I18n::instance()->get($key);
}