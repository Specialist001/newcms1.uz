<?php
namespace Modules\Admin\Model;

use Limber;
use Limber\Orm\Model
use Query;

class CustomFieldValue extends Model
{
    protected static $table = 'custom_field_value';
    /**
     * @param array $params
     * @return int
     */
    public function addUpdateFieldValue(array $params)
    {
        $customFieldValue = new CustomFieldValue();
        $id = $this->getIdFieldValue($params['element_id'], $params['field_id']);
        if ($id) {
            $customFieldValue->setAttribute('id', $id);
        }
        $customFieldValue->setAttribute('field_id', $params['field_id']);
        $customFieldValue->setAttribute('element_id', $params['element_id']);
        $customFieldValue->setAttribute('value', $params['value']);
        $customFieldValue->save();
        return $customFieldValue->getAttribute('id');
    }
    /**
     * @param int $elementId
     * @param int $fieldId
     * @return int
     */
    public function getIdFieldValue(int $elementId, int $fieldId)
    {
        $sql = "
          SELECT id
          FROM " . static::$table . "
          WHERE field_id={$fieldId}
            AND element_id={$elementId}
        ";
        $query = Query::result($sql);
        return isset($query[0]) ? $query[0]->id : 0;
    }
}