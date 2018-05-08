<?php
namespace Modules\Admin\Model;

use Limber\Orm\Model;
use Query;

class MenuItem extends Model
{
    const NEW_MENU_ITEM_NAME = 'New item';
    const FIELD_NAME = 'name';
    const FIELD_LINK = 'link';

    protected static $table = 'menu_item';

    public function getItems(int $menuId, array $params = []): array
    {
        $query = Query::table(static::$table, __CLASS__)
            ->select()
            ->where('menu_id', '=', $menuId)
            ->orderBy('position')
            ->all();

        return $query;
    }

    public function sort(array $params = [])
    {
        $items = isset($params['data']) ? json_decode($params['data']) : [];

        if (!empty($items) and isset($items[0])) {
            foreach ($items[0] as $position => $item) {
                Query::table(static::$table, __CLASS__)
                    ->update([
                        'position' => $position
                    ])
                    ->where('id', '=', $item->id)
                    ->run('update');
            }
        }
    }

    public function remove(int $itemId)
    {
        Query::table(static::$table, __CLASS__)
            ->where('id', '=', $itemid)
            ->run('delete');
    }
}