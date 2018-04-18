<?php
namespace Limber\Cms\Admin\Model;

use Limber\Orm\Model;
use Query;

class Setting extends Model
{
    const SECTION_GENERAL = 'general';

    protected static $table = 'setting';

    public function getSettings()
    {
        $query = Query::table(static::$table, __CLASS__)
            ->select()
            ->where('section', '=', self::SECTION_GENERAL)
            ->orderBy('id')
            ->all();

        return $query;
    }

    public function update(array $params)
    {
        print_r($params);
        if (!empty($params)) {
            foreach ($params as $key => $value) {
                Query::table(static::$table, __CLASS__)
                    ->update(['value' => $value])
                    ->where('key_field', '=', $key)
                    ->run('update');
            }
        }
    }
}