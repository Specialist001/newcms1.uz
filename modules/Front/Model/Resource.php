<?php
namespace Modules\Front\Model;

use Limber\Orm\Model;
use Limber\Orm\Query;

class Resource extends Model
{
    protected static $table = 'resource';
    /**
     * @param string $segment
     * @return bool|Model
     */
    public function getResourceBySegment(string $segment)
    {
        $query = Query::table(self::$table, __CLASS__)
            ->select()
            ->where('segment', '=', $segment)
            ->first();
        return $query;
    }
    /**
     * @param array $params
     * @return array|Query
     */
    public function getResources(int $typeId, array $params = [])
    {
        $fields = [];
        $query = Query::table(static::$table, __CLASS__)
            ->select($fields)
            ->where('resource_type_id', '=', $typeId);

        if (isset($params['order_by']) && is_array($params['order_by'])) {
            foreach ($params['order_by'] as $column => $direction) {
                $query = $query->orderBy($column, $direction);
            }
        }

        $query = $query->all();

        return $query;
    }
}