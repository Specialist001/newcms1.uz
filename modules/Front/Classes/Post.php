<?php
namespace Modules\Front\Classes;

use Limber;

class Post
{
    public static function getPostsInIds(array $ids): array
    {
        $postModel = new Modules\Front\Model\Post();

        return $postModel->getPostsInId($ids);
    }
}