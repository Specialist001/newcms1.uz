<?php
namespace Limber\Cms\Admin\Controller;

use Limber;
use Limber\Helper\ImageUploader;
use Limber\Http\Input;
use Limber\Http\Uri;
use Limber\Cms\Admin\Model\Post as PostModel;
use Limber\Localization\I18n;
use \View;

class PostController extends AdminController
{
    public function listing()
    {
        I18n::instance()->load('posts/list');

        $postModel = new PostModel();
        $posts     = $postModel->getPosts();

        return View::make('posts/list', [
           'posts' => $posts
        ]);
    }

    public function create()
    {
        I18n::instance()->load('posts/create');

        return View::make('posts/create');
    }

    public function edit($id)
    {
        I18n::instance()->load('posts/edit');

        $postModel = new PostModel();
        $fileModel = new Limber\Cms\Admin\Model\File();

        $post      = $postModel->getPost($id);

        $image = false;
        if ($post->getAttribute('thumbnail')) {
            $image = $fileModel->getFile($post->getAttribute('thumbnail'));
        }

        return View::make('posts/edit', [
            'baseUrl'   => Uri::base(),
            'post'      => $post,
            'pageTypes' => getTypes('post'),
            'image'     => $image
        ]);
    }

    public function add()
    {
        $params = Input::post();

        if (isset($params['title'])) {
            $post = new Limber\Cms\Admin\Model\Post;
            $post->setAtrribute('title', $params['title']);
            $post->setAtrribute('content', $params['content']);
            $post->setAttribute('segment', Limber\Helper\Text::transliteration($params['title']));
            $post->save();

            echo $post->getAttribute('id');
            exit;
        }
    }

    public function update()
    {
        $params = Input::post();

        $files = Input::files();

        $fileId = 0;
        if (!empty($files)) {
            $fileModel = new Limber\Cms\Admin\Model\File;

            $uploadFile = $files[0];
            $uploadsDir = path_content('uploads') . '/' . date('Y-m') . '/';
            $name       = 'image-' . time();

            if (!file_exists($uploadsDir)) {
                mkdir($uploadsDir);
            }

            $file = new ImageUploader($uploadFile);
            $file->sendTo = $uploadsDir;
            $file->imageName = $name;

            $upload = $file->uploadImage();

            if ($upload->isUploaded) {
                $params['image'] = $upload->uploadedName;

                $fileId = $fileModel->addFile([
                   'name' => $upload->uploadedName,
                   'link' => '/content/uploads/' . date('Y-m') . '/' . $upload->uploadedName,
                   'type' => $uploadFile['type']
                ]);
            }
        }

        if (isset($params['title'])) {
            $post = new Limber\Cms\Admin\Model\Post;
            $post->setAttribute('id', $params['page_id']);
            $post->setAttribute('title', $params['title']);
            $post->setAttribute('content', $params['content']);
            if ($fileId) {
                $post->setAttribute('thumbnail', $fileId);
            }

            $post->setAttribute('status', $params['status']);
            $post->setAttribute('type', $params['type']);
            $post->save();

            echo $post->getAttribute('id');
            exit;
        }
    }
}