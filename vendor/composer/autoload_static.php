<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitd78598d25841a8903f8aa9796c9a1ac1
{
    public static $files = array (
        '0e6d7bf4a5811bfa5cf40c5ccd6fae6a' => __DIR__ . '/..' . '/symfony/polyfill-mbstring/bootstrap.php',
        'fc2cda83e7398d18a704e14283685209' => __DIR__ . '/../..' . '/limber/Functions/functions.php',
        '85ffabecfda2655e8f603a5bede55813' => __DIR__ . '/../..' . '/limber/Functions/localization.php',
        '64db375941dde7b423f4164c871baeef' => __DIR__ . '/../..' . '/limber/Functions/menus.php',
    );

    public static $prefixLengthsPsr4 = array (
        'T' => 
        array (
            'Twig\\' => 5,
        ),
        'S' => 
        array (
            'Symfony\\Polyfill\\Mbstring\\' => 26,
        ),
        'P' => 
        array (
            'Plugin\\' => 7,
        ),
        'M' => 
        array (
            'Modules\\' => 8,
        ),
        'L' => 
        array (
            'Limber\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Twig\\' => 
        array (
            0 => __DIR__ . '/..' . '/twig/twig/src',
        ),
        'Symfony\\Polyfill\\Mbstring\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-mbstring',
        ),
        'Plugin\\' => 
        array (
            0 => __DIR__ . '/../..' . '/content/plugins',
        ),
        'Modules\\' => 
        array (
            0 => __DIR__ . '/../..' . '/modules',
        ),
        'Limber\\' => 
        array (
            0 => __DIR__ . '/../..' . '/limber',
        ),
    );

    public static $prefixesPsr0 = array (
        'T' => 
        array (
            'Twig_' => 
            array (
                0 => __DIR__ . '/..' . '/twig/twig/lib',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitd78598d25841a8903f8aa9796c9a1ac1::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitd78598d25841a8903f8aa9796c9a1ac1::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInitd78598d25841a8903f8aa9796c9a1ac1::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}
