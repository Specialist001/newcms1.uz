<?php

namespace Admin\Controller;

class SettingController extends AdminController
{
    public function general()
    {
        $this->view->render('setting/general');
    }
}