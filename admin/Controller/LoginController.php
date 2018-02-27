<?php

namespace Admin\Controller;


class LoginController extends AdminController
{
    public function form(){
        //print_r($this->request->server['HTTP_HOST']);
        $this->view->render('login');
    }

}