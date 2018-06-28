<?php
namespace Modules\Frontend\Model;

use Limber\Orm\Model;
use Limber\Orm\Query;

class MenuItem extends Model
{
    protected static $table = 'menu_item';

    public function getItemsByMenuId(int $menuId, array $params = [])
    {
        $query = Query::table(static::$table)
            ->select()
            ->where('menu_id', '=', $menuId)
            ->orderBy('position', 'asc')
            ->all();

        return $query;
    }
}