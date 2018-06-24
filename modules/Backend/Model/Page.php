<?php
namespace Modules\Backend\Model;

use Limber\Orm\Model;
use Query;

class Page extends Model
{
    protected static $table = 'page';

    public function getPages()
    {
        $query = Query::table(static::$table, __CLASS__)
            ->select()
            ->orderBy('id', 'desc')
            ->all();

        return $query;
    }

    public function getPage(int $id)
    {
        return Query::table(static::$table, __CLASS__)
            ->select()
            ->where('id', '=', $id)
            ->first();
    }
}