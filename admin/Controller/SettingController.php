<?php

namespace Admin\Controller;

class SettingController extends AdminController
{
    public function general()
    {
        $this->load->model('Setting');

        $this->data['settings'] = $this->model->setting->getSettings();
        $this->data['languages'] = languages();

        $this->view->render('setting/general', $this->data);
    }

    public function updateSetting()
    {
        $this->load->model('Setting');

        $params = $this->request->post;
        $update = $this->model->setting->update($params);

        echo $update;
    }
}