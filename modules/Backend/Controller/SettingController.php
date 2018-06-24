<?php
namespace Modules\Backend\Controller;

use Limber\Http\Input;
use Limber\Localization\I18n;
use Modules\Backend\Model\Setting as SettingModel;
use Modules\Backend\Model\Menu as MenuModel;
use Modules\Backend\Model\MenuItem as MenuItemModel;
use Limber\Settings\Setting;
use \View;

class SettingController extends BackendController
{
    public function __construct()
    {
        parent::__construct();

        $this->setData('settingNavItems', \Customize::instance()->getAdminSettingItems());
    }

    public function general()
    {
        I18n::instance()->load('settings/general');

        $settingModel = new SettingModel();
        $settings = $settingModel->getSettings();
        $languages = I18n::instance()->all();

        $this->setData('settings', $settings);
        $this->setData('languages', $languages);

        return View::make('settings/general', $this->data);
    }

    public function menus()
    {
        I18n::instance()->load('settings/menus');

        $menuModel = new MenuModel();
        $menuItemModel = new MenuItemModel();

        $menuId    = (int)Input::get('menu_id');
        $menus     = $menuModel->getList();
        $menuItems = $menuItemModel->getItems($menuId);

        $this->setData('menus', $menus);
        $this->setData('menuId', $menuId);
        $this->setData('editMenu', $menuItems);

        return View::make('settings/menus', $this->data);
    }

    public function themes()
    {
        I18n::instance()->load('settings/themes');

        $this->setData('themes', get_themes());
        $this->setData('activeTheme', Setting::value('active_theme', 'theme'));

        return View::make('settings/themes', $this->data);
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
            $menu = new \Modules\Backend\Model\Menu;
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
            $menuItem = new \Modules\Backend\Model\MenuItem;
            $menuItem->setAttribute('menu_id', $params['menu_id']);
            $menuItem->setAttribute('name', \Modules\Backend\Model\MenuItem::NEW_MENU_ITEM_NAME);
            $menuItem->setAttribute('link', '#');
            $menuItem->save();

            echo \View::make('settings/menu_item', [
                'item' => $menuItem
            ])->render();
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
            $menuItem = new \Modules\Backend\Model\MenuItem;
            $menuItem->setAttribute('id', $params['item_id']);

            if ($params['field'] == \Modules\Backend\Model\MenuItem::FIELD_NAME) {
                $menuItem->setAttribute(\Modules\Backend\Model\MenuItem::FIELD_NAME, $params['value']);
            }

            if ($params['field'] == \Modules\Backend\Model\MenuItem::FIELD_LINK) {
                $menuItem->setAttribute(\Modules\Backend\Model\MenuItem::FIELD_LINK, $params['value']);
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