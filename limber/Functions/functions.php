<?php

function path($section)
{
    switch (strtolower($section))
    {
        case 'config':
            return $_SERVER['DOCUMENT_ROOT'] . '/config/';
        case 'modules':
            return $_SERVER['DOCUMENT_ROOT'] . '/modules/';
        case 'content':
            return $_SERVER['DOCUMENT_ROOT'] . 'content/';
        default:
            return $_SERVER['DOCUMENT_ROOT'];

    }
}

function path_content($section = '')
{
    switch (strtolower($section))
    {
        case 'themes':
            return path('content') . 'themes';
        case 'plugins':
            return path('content') . 'plugins';;
        case 'uploads':
            return path('content') . 'uploads';
        default:
            return path('content');
    }
}

function languages()
{
    $directory = path('language');
    $list      = scandir($directory);
    $languages = [];

    if (!empty($list)) {
        unset($list[0]);
        unset($list[1]);

        foreach ($list as $dir) {
            $pathLangDir = $directory . DS . $dir;
            $pathConfig  = $pathLangDir . '/config.json';
            if (is_dir($pathLangDir) and is_file($pathConfig)) {
                $config = file_get_contents($pathConfig);
                $info   = json_decode($config);

                $languages[] = $info;
            }
        }
    }

    return $languages;
}

function getThemes()
{
    $themesPath = path_content('themes');
    $list       = scandir($themesPath);
    $themes     = [];

    if(!empty($list)) {

        foreach ($list as $dir) {
            // Ignore hidden directories.
            if ($dir === '.' || $dir === '..') continue;

            $pathThemeDir = $themesPath . '/' . $dir;
            $pathConfig   = $pathThemeDir . '/theme.json';
            $pathScreen   = '/content/themes/' . $dir . '/screen.jpg';

            if (is_dir($pathThemeDir) && is_file($pathConfig)) {
                $config = file_get_contents($pathConfig);
                $info   = json_decode($config);

                $info->screen   = $pathScreen;
                $info->dirTheme = $dir;

                $themes[] = $info;
            }
        }
    }

    return $themes;
}

function getPlugins()
{
    $pluginsPath = path_content('plugins');
    $list        = scandir($pluginsPath);
    $plugins     = [];

    if (!empty($list)) {

        foreach ($list as $namePlugin) {
            // Ignore hidden directories.
            if ($namePlugin === '.' || $namePlugin === '..') continue;

            $namespace = '\\Plugin\\' . $namePlugin . '\\Plugin';

            if (class_exists($namespace)) {
                $plugin = new $namespace();
                $plugins[$namePlugin] = $plugin->details();
            }
        }
    }

    return $plugins;
}

function getTypes($switch = 'page')
{
    $themePath = path_content('themes') . '/' . \Setting::value('active_theme', 'theme');
    $list      = scandir($themePath);
    $types     = [];

    if (!empty($list)) {

        foreach ($list as $name) {
            // Ignore hidden directories.
            if ($name === '.' || $name === '..') continue;

            if (\Limber\Helper\Common::searchMatchString($name, $switch)) {
                $chunk = explode('.', $name, 3);

                if ($chunk[0] == $switch && $chunk[1] == 'phtml') continue;

                list($switch, $key, $extension) = $chunk;

                // Ignore files.
                if ($key === $switch || $key === 'layout') continue;

                if (!empty($key)) {
                    $types[$key] = ucfirst($key);
                }
            }
        }
    }

    return $types;
}

function getLayouts()
{
    $themePath = path_content('themes') . '/' . \Setting::value('active_theme', 'theme');
    $list = scandir($themePath);
    $layouts = [];
    if (!empty($list)) {
        foreach ($list as $name) {
            // Ignore hidden directories.
            if ($name === '.' || $name === '..') continue;
            if (\Limber\Helper\Common::searchMatchString($name, 'layout')) {
                $chunk = explode('.', $name, 3);
                list($switch, $key, $extension) = $chunk;
                // Ignore files.
                if ($switch === 'main' || $key !== 'layout') continue;
                if (!empty($key)) {
                    $layouts[$switch] = ucfirst($switch);
                }
            }
        }
    }
    return $layouts;
}