<?php

namespace Admin\Controller;

use Engine\Core\Template\Theme;

class SettingController extends AdminController
{
    public function general()
    {
        $this->load->model('Setting');

        $this->data['settings'] = $this->model->setting->getSettings();
        $this->data['languages'] = languages();

        $this->view->render('setting/general', $this->data);
    }

    public function menus()
    {
        $this->load->model('Menu', false, 'Cms');
        $this->load->model('MenuItem', false, 'Cms');

        $this->data['menuId']   = $this->request->get['menu_id'];
        $this->data['menus']    = $this->model->menu->getList();
        $this->data['editMenu'] = $this->model->menuItem->getItems($this->data['menuId']);

        $this->view->render('setting/menus', $this->data);
    }

    public function updateSetting()
    {
        $this->load->model('Setting');

        $params = $this->request->post;
        $this->model->setting->update($params);
    }
}