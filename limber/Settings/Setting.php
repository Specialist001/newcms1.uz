<?php
namespace Limber\Settings;

class Setting
{
    public static function item($key, $section = 'general')
    {
        if (!Repository::retrieve($section, $key)) {
            self::get($section);
        }

        return Repository::retrieve($section, $key);
    }

    public static function value($key, $section = 'general')
    {
        /** @var \Limber\Orm\Model $item */
        $item = static::item($key, $section);

        return $item ? $item->getAttribute('value') : '';
    }

    public static function get(string $section): bool
    {
        $settings = \Modules\Admin\Model\Setting::select()
            ->where('section', '=', $section)
            ->all();

        if (is_array($settings) && !empty($settings)) {
            //store items
            foreach ($settings as $key => $value)
            {
                Repository::store($section, $value);
            }

            return true;
        }

        return false;
    }
}