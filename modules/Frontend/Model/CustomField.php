<?php
namespace Modules\Front\Model;

use Limber;
use Limber\CustomField\Params;
use Limber\Orm\Model;
use Query;

class CustomField extends Model
{
    protected static $table = 'custom_field';

    public function getFieldValue()
    {

    }

    public static function getFieldByName(int $elementId, string $name)
    {
        $sql = "
            SELECT
              cf.name,
              cfv.value
            FROM custom_field as cf
            JOIN custom_field_value as cfv
              ON cf.id=cfv.field_id
            WHERE cf.name = '{$name}'
              AND cfv.element_id = {$elementId};
        ";

        $result = Query::result($sql);

        return isset($result[0]) ? $result[0]->value : '';
    }

    public function getListFieldsByGroupIds(int $elementId, array $groupIds): array
    {
        $sql = "
            SELECT
              cf.*,
              (
                SELECT
                  value
                FROM
                  " . CustomFieldValue::getTable() . "
                  WHERE element_id = {$elementId}
                   AND field_id = cf.id
              ) as value
            FROM
              " . static::$table . " as cf
            WHERE cf.group_id IN(" . implode(',', $groupIds) . ")
        ";

        return Query::result($sql);
    }
}