<?php
namespace Limber\Cms\Front\Model;

use Limber\Orm\Model;
use Limber\Orm\Query;

class Page extends Model
{
    protected static $table = 'page';

    public function getPageBySegment($segment)
    {
        $query = Query::table(self::$table, __CLASS__)
            ->select()
            ->where('segment', '=', $segment)
            ->first()
        ;
        return $query;
    }

    public function getPages(array $params = [])
    {
        $fields = [];

        $query = Query::table(static::$table, __CLASS__)
            ->select($fields);

        if (isset($params['layout'])) {
            $query = $query->where('layout', '=', $params['layout']);
        }

        $query = $query->all();

        return $query;
    }
}