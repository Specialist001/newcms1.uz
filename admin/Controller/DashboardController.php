<?php

namespace Admin\Controller;


class DashboardController extends AdminController
{
    public function index(){
        //print_r($this->di->get('config'));
        $this->view->render('dashboard');
    }
}