<?php
namespace Limber;

class Define
{
    const NAME    = 'Limber CMS';
    const VERSION = '0.0.1';
    const EXEC    = true;
    const PHP_MIN = '7.0.0';
    const DEFAULT_MODULE = [
        'admin' => 'Backend',
        'front' => 'Frontend'
    ];

    const VIEW_PATH_MASK = [
        'module' => '%s/View/%s',
        'theme'  => '%s/content/themes/%s'
    ];
}