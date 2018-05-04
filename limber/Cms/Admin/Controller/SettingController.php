<?php
namespace Limber\Cms\Admin\Controller;

use Limber\Http\Input;
use Limber\Localization\I18n;
use Limber\Cms\Admin\Model\Setting as SettingModel;
use Limber\Cms\Admin\Model\Menu as MenuModel;
use Limber\Cms\Admin\Model\MenuItem as MenuItemModel;
use Limber\Settings\Setting;
use \View;

class SettingController extends AdminController
{
    public function general()
    {
        I18n::instance()->load('settings/general');

        $settingModel = new SettingModel();
        $settings = $settingModel->getSettings();
        $languages = I18n::instance()->all();

        return View::make('settings/general', [
           'settings'   => $settings,
            'languages' => $languages
        ]);
    }

    public function menus()
    {
        I18n::instance()->load('settings/menus');

        $menuModel = new MenuModel();
        $menuItemModel = new MenuItemModel();

        $menuId    = (int)Input::get('menu_id');
        $menus     = $menuModel->getList();
        $menuItems = $menuItemModel->getItems($menuId);

        return View::make('settings/menus', [
            'menus' => $menus,
            'menuId' => $menuId,
            'editMenu' => $menuItems
        ]);
    }

    public function themes()
    {
        I18n::instance()->load('settings/themes');

        return View::make('settings/themes', [
            'themes' => getThemes(),
            'activeTheme' => Setting::value('active_theme', 'theme')
        ]);
    }

    public function activateTheme()
    {
        $theme = Input::post('theme');

        SettingModel::where('key_field', '=', 'active_theme')
            ->update([
                'value' => $theme
            ])
            ->run('update')
        ;

        exit;
    }

    public function ajaxMenuAdd()
    {
        $params = Input::post();
        if (isset($params['name']) && strlen($params['name']) > 0) {
            $menu = new \Limber\Cms\Admin\Model\Menu;
            $menu->setAttribute('name', $params['name']);
            $menu->save();

            echo $menu->getAttribute('id');
        }
        exit;
    }

    public function ajaxAddMenuItem()
    {
        $params = Input::post();
        if (isset($params['menu_id']) && strlen($params['menu_id']) > 0) {
            $menuItem = new \Limber\Cms\Admin\Model\MenuItem;
            $menuItem->setAttribute('menu_id', $params['menu_id']);
            $menuItem->setAttribute('name', \Limber\Cms\Admin\Model\MenuItem::NEW_MENU_ITEM_NAME);
            $menuItem->save();
            $item = new \stdClass;
            $item->id   = $menuItem->getAttribute('id');
            $item->name = \Limber\Cms\Admin\Model\MenuItem::NEW_MENU_ITEM_NAME;
            $item->link = '#';
            echo \Component::get('settings/menu_item', [
                'item' => $item
            ]);
        }
        exit;
    }

    public function ajaxMenuSortItems()
    {
        $params = Input::post();
        if (isset($params['data']) && !empty($params['data'])) {
            $menuItemModel = new MenuItemModel();
            $menuItemModel->sort($params);
        }
        exit;
    }

    public function ajaxMenuUpdateItem()
    {
        $params = Input::post();
        if (isset($params['item_id']) && strlen($params['item_id']) > 0) {
            $menuItem = new \Limber\Cms\Admin\Model\MenuItem;
            $menuItem->setAttribute('id', $params['item_id']);

            if ($params['field'] == \Limber\Cms\Admin\Model\MenuItem::FIELD_NAME) {
                $menuItem->setAttribute(\Limber\Cms\Admin\Model\MenuItem::FIELD_NAME, $params['value']);
            }

            if ($params['field'] == \Limber\Cms\Admin\Model\MenuItem::FIELD_LINK) {
                $menuItem->setAttribute(\Limber\Cms\Admin\Model\MenuItem::FIELD_LINK, $params['value']);
            }

            $menuItem->save();
        }
        exit;
    }

    public function ajaxMenuRemoveItem()
    {
        $params = Input::post();
        if (isset($params['item_id']) && strlen($params['item_id']) > 0) {
            $menuItemModel = new MenuItemModel();
            $menuItemModel->remove($params['item_id']);
            echo $params['item_id'];
        }
        exit;
    }

    public function updateSetting()
    {
        $settingModel = new SettingModel();
        $params = Input::post();

        $settingModel->update($params);
        exit;
    }
}