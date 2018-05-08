<?php
namespace Limber\Cms\Front\Model;

use Limber\Orm\Model;
use Query;

class Post extends Model
{
    protected static $table = 'post';

    public function getPostsInId(array $ids)
    {
        if (empty($ids))    return [];

        $result = Query::result("
            SELECT
                *
            FROM " . static::$table . "
            WHERE id IN(" . implode(',', $ids) . ")
            ");

        return $result;
    }

    public function getPost($id)
    {
        return Query::table(static::$table, __CLASS__)
            ->select()
            ->where('id', '=', $id)
            ->first();
    }
}