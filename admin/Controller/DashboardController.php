<?php

namespace Admin\Controller;

class DashboardController extends AdminController
{
    public function index()
    {
        //load Models
        $this->load->model('User');

        //load language
        $this->load->language('dashboard/main');

        //rendering
        $this->view->render('dashboard');
    }
}