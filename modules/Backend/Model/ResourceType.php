<?php
namespace Modules\Backend\Model;

use Limber\Orm\Model;
use Query;

class ResourceType extends Model
{
    protected static $table = 'resource_type';
    /**
     * @param array $params
     * @return bool
     */
    public function addResourceType(array $params)
    {
        $resourceType = new ResourceType;
        $resourceType->setAttribute('title', $params['title']);
        $resourceType->setAttribute('name', $params['name']);
        return $resourceType->save();
    }
    public function getResourcesType()
    {
        $query = Query::table(static::$table, __CLASS__)
            ->select()
            ->orderBy('id', 'asc')
            ->all()
        ;
        return $query;
    }
    /**
     * @param string $name
     * @return bool|Model
     */
    public function getResourceTypeByName(string $name)
    {
        return Query::table(static::$table, __CLASS__)
            ->select()
            ->where('name', '=', $name)
            ->first();
    }
    /**
     * @param int $id
     * @return bool|Model
     */
    public function getResourceType(int $id)
    {
        return Query::table(static::$table, __CLASS__)
            ->select()
            ->where('id', '=', $id)
            ->first();
    }
}