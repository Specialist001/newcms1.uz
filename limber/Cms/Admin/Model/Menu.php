<?php
namespace Limber\Cms\Admin\Model;

use Limber\Orm\Model;
use Query;

class Menu extends Model
{
    protected static $table = 'menu';

    public function getList()
    {
        $query = Query::table(static::$table, __CLASS__)
            ->select()
            ->orderBy('id','desc')
            ->all();

        return $query;
    }
}