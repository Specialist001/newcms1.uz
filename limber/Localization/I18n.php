<?php
namespace Limber\Localization;

use Limber\Config\Config;
use Limber\Routing\Module;

class I18n
{
    private static $instance;

    public static function instance(): I18n
    {
        if (self::$instance == null) {
            self::$instance = new I18n();
        }
        return self::$instance;
    }

    public function get(string $key, array $data = []): string
    {
        $lang = \DI::instance()->get('lang');
        $text = isset($lang[$key]) ? $lang[$key] : '';

        if (!empty($data)) {
            $text = sprintf($text, ...$data);
        }

        return $text;
    }

    public function load(string $file, string $module = '')
    {
        $path    = static::path($module) . $file . '.ini';
        $content = parse_ini_file($path, true);
        $lang = \DI::instance()->get('lang') ?: [];

        foreach ($content as $key => $value) {
            $keyLang = str_replace('/', '.', $file) . '.' . $key;

            if (is_array($value)) {
                foreach ($value as $k => $v) {
                    $lang[$keyLang . '.' . $k] = $v;
                }
            } else {
                $lang[$keyLang] = $value;
            }
        }
        \DI::instance()->set('lang', $lang);
        return $this;
    }

    public function all(): array
    {
        /** @var Module $module */
        $module = \DI::instance()->get('module');

        $localizations = [];

        $path = path('modules') . sprintf('%s/Language/', $module->module);

        foreach (scandir($path) as $localization) {

            // Ignore hidden directories.
            if ($localization === '.' || $localization === '..') continue;

            // Does the language have a valid lang.php?
            $local = $path . $localization . '/lang.json';
            if (is_file($local)) {

                // Add it to the lang array.
                array_push($localizations, json_decode(
                    file_get_contents($local)
                ));
            }
        }
        return $localizations;
    }

    private static function path(string $moduleName = ''): string
    {
        $activeLanguage = \Setting::value('language');
        if ($activeLanguage == '') {
            $activeLanguage = Config::item('defaultLang');
        }

        /** @var Module $module */
        $module = \DI::instance()->get('module');

        $moduleModuleName = $module->module;
        if ($moduleName !== '') {
            $moduleModuleName = $moduleName;
        }

        $path = path('modules') . sprintf('%s/Language/%s/', $moduleModuleName, $activeLanguage);

        return $path;
    }
}