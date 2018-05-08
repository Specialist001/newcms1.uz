<?php
namespace Limber\Cms\Front\Classes;

use Limber\Cms\Front\Model\CustomField as CustomFieldModel;

class Field
{
    public static function get($id, $name, $type = 'page')
    {
        return CustomFieldModel::getFieldByModel($id, $name);
    }
}