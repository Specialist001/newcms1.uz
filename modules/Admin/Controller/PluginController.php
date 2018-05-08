<?php
namespace Modules\Admin\Controller;

use Limber\Localization\I18n;
use View;
use Modules\Admin\Model\Plugin as PluginModel;

class PluginController extends AdminController
{
    public function listPlugins()
    {
        I18n::instance()->load('plugins/list');

        $pluginModel = new PluginModel();
        $installedPlugins = $pluginModel->getPlugins();
        $plugins = getPlugins();

        foreach ($plugins as $key => $plugin) {
            $plugins[$key]['is_active'] = 0;
            $plugins[$key]['is_install'] = false;
            $plugins[$key]['plugin_id'] = 0;
        }

        foreach ($installedPlugins as $plugin) {
            $plugins[$plugin->directory]['is_active'] = $plugin->is_active;
            $plugins[$plugin->directory]['is_install'] = true;
            $plugins[$plugin->directory]['plugin_id'] = $plugin->id;
        }

        return View::make('plugins/list', [
            'plugins' => $plugins,
        ]);
    }
}