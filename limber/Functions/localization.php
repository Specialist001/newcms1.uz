<?php

function __($key, $data = [])
{
    echo \Limber\Localization\I18n::instance()->get($key, $data);
}

function __e($key, $data = [])
{
    return \Limber\Localization\I18n::instance()->get($key, $data);
}