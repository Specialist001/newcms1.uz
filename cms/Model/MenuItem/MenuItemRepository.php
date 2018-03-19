<?php

namespace Cms\Model\Menu;

use Engine\Model;

class MenuItemRepository extends Model
{
    const NEW_MENU_ITEM_NAME = 'New item';

    public function getItems($menuId, $params = [])
    {
        $sql = $this->queryBuilder
            ->select()
            ->from('menu_item')
            ->where('menu_id', $menuId)
            ->orderBy('position', 'ASC')
            ->sql();

        return $this->db->query($sql, $this->queryBuilder->values);
    }
}