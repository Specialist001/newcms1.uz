<?php
namespace Modules\Front\Classes;

use Modules\Front\Model\CustomField as CustomFieldModel;

class Field
{
    public static function get($id, $name)
    {
        return CustomFieldModel::getFieldByModel($id, $name);
    }
}