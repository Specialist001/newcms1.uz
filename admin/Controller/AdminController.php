<?php

namespace Admin\Controller;

use Engine\Controller;
use Engine\Core\Auth\Auth;

class AdminController extends Controller
{
    /**
     * @var Auth
     */
    protected $auth;

    /**
     * AdminController constructor.
     * @param \Engine\DI\DI $di
     */
    public function __construct($di)
    {
        parent::__construct($di);

        $this->auth = new Auth();

        //print_r($_COOKIE);

        if($this->auth->hashUser() !== null){
//          $this->auth->unAuthorize();
            header('Location: /admin/login/');
        }
//        else{
//            $this->checkAuthorization();
//        }
    }

    public function checkAuthorization(){

//        if($this->auth->hashUser() != null){
//            $this->auth->authorize($this->auth->hashUser());
//        }
//
//        if(!$this->auth->authorized()){
//            //redirect
//            header('Location: /admin/login/');
//            exit;
//        }
    }

    public function logOut(){
        $this->auth->unAuthorize();
        header('Location: /admin/login/');
        exit;
    }

}