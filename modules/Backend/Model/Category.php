<?php
namespace Modules\Backend\Model;

use Limber\Orm\Model;

class Category extends Model
{
    protected static $table = 'category';

    public function add(array $params)
    {
        $category = new Category();
        $category->setAttribute('parent_id', 0);
        $category->setAttribute('resource_type_id', $params['resource_type_id']);
        $category->setAttribute('image', 0);
        $category->save();

        $categoryId = $category->getAttribute('id');

        if (isset($params['name']) && isset($params['description'])) {
            foreach ($params['name'] as $code => $name) {
                CategoryDescription::add([
                    'category_id' => $categoryId,
                    'language' => $code,
                    'name' => $name,
                    'description' => $params['description'][$code]
                ]);
            }
        }

        return $categoryId;
    }

    public function getCategoryById(int $id)
    {
        $sql = "
            SELECT
              c.*,
              cd.*
            FROM " .static::$table . " as c
            JOIN " . CategoryDescription::getTable() . " as cd
              ON c.id = cd.category_id
            WHERE c.id = {$id}
            ORDER BY id ASC 
        ";

        $result = \Query::result($sql);
        $category = [];

        foreach ($result as $item) {
            $category[$item->language] = $item;
        }

        return $category;
    }

    public function getCategoriesByResourceType(int $resourceTypeId, string $language)
    {
        $sql = "
          SELECT 
            c.*,
            cd.*
          FROM " . static::$table . " as c
          JOIN " . CategoryDescription::getTable() . " as cd
            ON c.id = cd.category_id AND cd.language = '{$language}'
          WHERE c.resource_type_id = {$resourceTypeId}
          ORDER BY id ASC
          ";

        return \Query::result($sql);
    }
}