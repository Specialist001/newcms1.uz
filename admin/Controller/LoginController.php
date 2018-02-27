<?php

namespace Admin\Controller;

use Engine\Controller;
use Engine\DI\DI;

class LoginController extends Controller
{
    /**
     * LoginController constructor.
     * @param DI $di
     */
    public function __construct(DI $di)
    {
        parent::__construct($di);
    }

    public function form(){
        //print_r($this->request->server['HTTP_HOST']);
        $this->view->render('login');
    }

    public function authAdmin(){
        $params = $this->request->post;

        print_r($params);
    }

}