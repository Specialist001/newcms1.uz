<?php
namespace Modules\Frontend\Classes;

use Modules;

class Post
{
    public static function getPostsInIds(array $ids): array
    {
        $postModel = new Modules\Frontend\Model\Post();

        return $postModel->getPostsInId($ids);
    }
}