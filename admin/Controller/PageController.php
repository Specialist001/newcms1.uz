<?php

namespace Admin\Controller;

class PageController extends AdminController
{
    //private $data = [];

    public function listing(){
        $pageModel = $this->load->model('Page');

        $data['pages'] = $pageModel->repository->getPages();
        //$this->data['pages'] = $pageModel->repository->getPages();

        $this->view->render('pages/list', $data);
        //$this->view->render('pages/list', $this->data);
    }

    public function create(){
        $pageModel = $this->load->model('Page');

        $this->view->render('pages/create');
    }

    public function edit($id){
        $pageModel = $this->load->model('Page');

        $this->data['page'] = $pageModel->repository->getPageData($id);
        //$page = $pageModel->repository->getPageData($id);
        //$data['page'] = $pageModel->repository->getPageData($id);

        $this->view->render('pages/edit', $this->data);
        //$this->view->render('pages/edit');
    }

    public function add(){
        $params    = $this->request->post;
        $pageModel = $this->load->model('Page');

        //$isPageParam = ['title', 'content'];

        if(isset($params['title'])){
            $pageId = $pageModel->repository->createPage($params);
            echo $pageId;
        }
    }

    public function update(){
        $params    = $this->request->post;
        $pageModel = $this->load->model('Page');

        if(isset($params['title'])){
            $pageId = $pageModel->repository->updatePage($params);
            echo $pageId;
        }
    }
}
