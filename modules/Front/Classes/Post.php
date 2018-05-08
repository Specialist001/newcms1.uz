<?php
namespace Limber\Cms\Front\Classes;

use Limber;

class Post
{
    public static function getPostsInIds(array $ids): array
    {
        $postModel = new Limber\Cms\Front\Model\Post();

        return $postModel->getPostsInId($ids);
    }
}