<?php
namespace Limber\Cms\Admin\Controller;

use Limber\Http\Input;
use Limber\Http\Uri;
use Limber\Cms\Admin\Model\Page as PageModel;
use \View;

class PageController extends AdminController
{
    public function listing()
    {
        $pageModel = new PageModel();
        $pages     = $pageModel->getPages();

        return View::make('pages/list', [
           'pages' => $pages
        ]);
    }

    public function create()
    {
        return View::make('pages/create');
    }

    public function edit($id)
    {
        $pageModel = new PageModel();
        $page      = $pageModel->getPage($id);

        return View::make('pages/edit', [
            'baseUrl' => Uri::base(),
            'page'    => $page
        ]);
    }

    public function add()
    {
        $params = Input::post();

        if (isset($params['title'])) {
            $page = new \Limber\Cms\Admin\Model\Page;
            $page->setAtrribute('title', $params['title']);
            $page->setAtrribute('content', $params['content']);
            $page->setAttribute('segment', \Limber\Helper\Text::transliteration($params['title']));
            $page->save();

            echo $page->getAttribute('id');
            exit;
        }
    }

    public function update()
    {
        $params = Input::post();

        if (isset($params['title'])) {
            $page = new \Limber\Cms\Admin\Model\Page;
            $page->setAttribute('id', $params['page_id']);
            $page->setAttribute('title', $params['title']);
            $page->setAttribute('content', $params['content']);
            $page->setAttribute('status', $params['status']);
            $page->setAttribute('type', $params['type']);
            $page->save();

            echo $page->getAttribute('id');
            exit;
        }
    }
}