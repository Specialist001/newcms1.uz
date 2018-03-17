<?php

namespace Engine\Core\Template;

use Admin\Model\Setting\SettingRepository;
use Engine\DI\DI;

class Setting
{
    protected static $di;

    protected static $settingRepository;

    public function __construct($di)
    {
        self::$di = $di;
        self::$settingRepository = new SettingRepository(self::$di);
    }

    /**
     * @param $keyField
     * @return mixed
     */
    public static function get($keyField)
    {
        return self::$settingRepository->getSettingValue($keyField);
    }
}