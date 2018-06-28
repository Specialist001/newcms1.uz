<?php
namespace Modules\Frontend\Model;

use Limber\Orm\Model;
use Limber\Orm\Query;

class Menu extends Model
{
    protected static $table = 'menu';

    public function getMenu(int $id)
    {
        //$query = Query::table(static::$table);
    }
}