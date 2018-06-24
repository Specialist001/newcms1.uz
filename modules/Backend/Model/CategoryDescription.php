<?php
namespace Modules\Backend\Model;

use Limber\Orm\Model;

class CategoryDescription extends Model
{
    protected static $table = 'category_description';

    public static function add(array $params)
    {
        $categoryDescription = new CategoryDescription();
        $categoryDescription->setAttribute('category_id', $params['category_id']);
        $categoryDescription->setAttribute('language', $params['language']);
        $categoryDescription->setAttribute('name', $params['name']);
        $categoryDescription->setAttribute('description', $params['description']);

        return $categoryDescription->save();
    }
}