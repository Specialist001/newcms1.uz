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
            'pages' => [
                'classIcon' => 'icon-doc icons',
                'urlPath'   => '/admin/pages/',
                'title'     => 'Pages'
            ],
            'posts' => [
                'classIcon' => 'icon-pencil icons',
                'urlPath'   => '/admin/posts/',
                'title'     => 'Posts'
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