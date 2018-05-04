<?php
namespace Limber\Cms\Admin\Model;

use Limber\Orm\Model;
use Query;

class File extends Model
{
    protected static $table = 'file';
    /**
     * @param array $params
     * @return int
     */
    public function addFile(array $params)
    {
        $file = new File;
        $file->setAttribute('name', $params['name']);
        $file->setAttribute('link', $params['link']);
        $file->setAttribute('type', $params['type']);
        $file->save();
        return $file->getAttribute('id');
    }
    /**
     * @param int $id
     * @return bool|Model
     */
    public function getFile(int $id)
    {
        $query = Query::table(static::$table)
            ->select()
            ->where('id', '=', $id)
            ->first()
        ;
        return $query;
    }
}