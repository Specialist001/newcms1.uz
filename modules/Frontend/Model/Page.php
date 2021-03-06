<?php
namespace Modules\Frontend\Model;

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

        if (isset($params['order_by']) && is_array($params['order_by'])) {
            foreach ($params['order_by'] as $column => $direction) {
                $query = $query->orderBy($column, $direction);
            }
        }

        $query = $query->all();

        return $query;
    }
}