<?php
namespace Modules\Backend\Model;

use Limber\Orm\Model;
use Query;

class Post extends Model
{
    protected static $table = 'post';

    public function getPosts()
    {
        $query = Query::table(static::$table, __CLASS__)
            ->select()
            ->orderBy('id', 'desc')
            ->all();

        return $query;
    }

    public function getPost($id)
    {
        return Query::table(static::$table, __CLASS__)
            ->select()
            ->where('id', '=', $id)
            ->first();
    }
}