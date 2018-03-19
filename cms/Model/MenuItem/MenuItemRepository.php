<?php

namespace Cms\Model\Menu;

use Engine\Model;

class MenuItemRepository extends Model
{
    public function getAllItems()
    {
        $sql = $this->queryBuilder->select()
            ->from('menu')
            ->orderBy('id', 'ASC')
            ->sql();

        return $this->db->query($sql);
    }
}