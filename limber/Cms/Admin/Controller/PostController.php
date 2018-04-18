<?php
namespace Limber\Cms\Admin\Controller;

use Limber\Http\Input;
use Limber\Http\Uri;
use Limber\Cms\Admin\Model\Post as PostModel;
use \View;

class PostController extends AdminController
{
    public function listing()
    {
        $postModel = new PostModel();
        $posts     = $postModel->getPosts();

        return View::make('posts/list', [
           'posts' => $posts
        ]);
    }

    public function create()
    {
        return View::make('posts/create');
    }

    public function edit($id)
    {
        $postModel = new PostModel();
        $post      = $postModel->getPost($id);

        return View::make('posts/edit', [
            'baseUrl' => Uri::base(),
            'post'    => $post
        ]);
    }

    public function add()
    {
        $params = Input::post();

        if (isset($params['title'])) {
            $post = new \Limber\Cms\Admin\Model\Post;
            $post->setAtrribute('title', $params['title']);
            $post->setAtrribute('content', $params['content']);
            $post->save();

            echo $post->getAttribute('id');
            exit;
        }
    }

    public function update()
    {
        $params = Input::post();

        if (isset($params['title'])) {
            $post = new \Limber\Cms\Admin\Model\Post;
            $post->setAttribute('id', $params['page_id']);
            $post->setAttribute('title', $params['title']);
            $post->setAttribute('content', $params['content']);
            $post->save();

            echo $post->getAttribute('id');
            exit;
        }
    }
}