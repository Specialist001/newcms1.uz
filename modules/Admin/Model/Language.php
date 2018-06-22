<?php
namespace Modules\Admin\Model;

use Limber\Orm\Model;

class Language extends Model
{
    protected static $table = 'language';

    public function getLanguages()
    {
        return \Query::table(static::$table)
            ->select()
            ->all();
    }
}