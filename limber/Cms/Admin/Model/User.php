<?php
namespace Limber\Cms\Admin\Model;

use Limber\Orm\Model;
use Limber\Orm\Query;

class User extends Model
{
    protected static $table = 'user';

    public function getUsers()
    {
        $query = Query::table(static::$table, __CLASS__)
            ->select()
            ->orderBy('id')
            ->all();

        return $query;
    }

    public function getUserByParams(array $params)
    {
        $query = Query::table(static::$table, __CLASS__)
            ->select()
            ->where('email', '=', $params['email'])
            ->where('password', '=', md5($params['password']))
            ->first();

        return $query;
    }

    public function updateHash($id, $hash)
    {
        Query::table(static::$table, __CLASS__)
            ->update(['hash' => $hash])
            ->where('id', '=', $id)
            ->run('update');
    }
}