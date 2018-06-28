<?php
namespace Modules\Frontend\Model;

use Limber\Orm\Model;
use Query;

class File extends Model
{
    protected static $table = 'file';

    public function getFileById(int $id) {
        $result = Query::result("
            SELECT
              *
            FROM " . static::$table . "
            WHERE id = " . $id . "
            LIMIT 1
        ");

        return isset($result[0]) ? $result[0] : null;
    }
}