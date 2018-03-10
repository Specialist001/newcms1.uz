<?php

namespace Cms\Controller;

class HomeController extends CmsController
{
    public function index(){
        $data = ['name' => 'Bob'];
        $this->view->render('index', $data);
//        echo 'Index Page';
    }

    public function news($id){
        echo $id;
    }

}
