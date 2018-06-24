<?php
namespace Modules\Front\Classes;

use Modules;

class Post
{
    public static function getPostsInIds(array $ids): array
    {
        $postModel = new Modules\Front\Model\Post();

        return $postModel->getPostsInId($ids);
    }
}