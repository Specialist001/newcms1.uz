<?php

namespace Limber\Customize;

class Config
{
    protected $config = [
        'dashboardMenu' => [
            'home' => [
                'classIcon' => 'icon-speedometer icons',
                'urlPath'   => '/admin/',
                'title'     => 'Home'
            ],
            'resources' => [
                'classIcon' => 'folder outline icon',
                'urlPath'   => '#',
                'title'     => 'Resources',
                'parents'   => []
            ],
            'plugins' => [
                'classIcon' => 'icon-wrench icons',
                'urlPath'   => '/admin/plugins/',
                'title'     => 'Plugins'
            ],
            'settings' => [
                'classIcon' => 'icon-equalizer icons',
                'urlPath'   => '/admin/settings/general/',
                'title'     => 'Settings'
            ]
        ],
        'settingMenu' => [
            'general' => [
                'urlPath' => '/admin/settings/general/',
                'title'   => 'General'
            ],
            'themes' => [
                'urlPath' => '/admin/settings/appearance/themes/',
                'title'   => 'Themes'
            ],
            'menus' => [
                'urlPath' => '/admin/settings/appearance/menus/',
                'title'   => 'Menus'
            ],
            'custom_fields' => [
                'urlPath'   => '/admin/settings/custom_fields/',
                'title'     => 'Custom Fields'
            ]
        ]
    ];

    /**
     * @param $key
     * @return bool
     */
    public function has($key)
    {
        return isset($this->config[$key]);
    }

    /**
     * @param $key
     * @return mixed|null
     */
    public function get($key)
    {
        return $this->has($key) ? $this->config[$key] : null;
    }

    public function set($key, $value)
    {
        $this->config[$key] = $value;
    }
}