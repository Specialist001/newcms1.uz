<?php
namespace Modules\Backend\Model;

use Limber\Orm\Model;
use Query;

class Plugin extends Model
{
    protected static $table = 'plugin';

    public function getPlugins()
    {
        $query = Query::table(static::$table, __CLASS__)
            ->select()
            ->orderBy('id')
            ->all();

        return $query;
    }
}