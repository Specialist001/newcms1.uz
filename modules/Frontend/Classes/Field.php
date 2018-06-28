<?php
namespace Modules\Frontend\Classes;

use Modules\Frontend\Model\CustomField as CustomFieldModel;

class Field
{
    public static function get($id, $name)
    {
        return CustomFieldModel::getFieldByModel($id, $name);
    }
}