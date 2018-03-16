<?php

namespace Admin\Model\Setting;

use Engine\Model;

class SettingRepository extends Model
{
    public function getSettings()
    {
        $sql = $this->queryBuilder->select()
            ->from('setting')
            ->orderBy('id', 'ASC')
            ->sql();

        return $this->db->query($sql);
    }

    public function update(array $params)
    {
        if (!empty($params)) {
            foreach ($params as $key => $value) {
                $sql = $this->queryBuilder
                    ->update('setting')
                    ->set([$key => $value])
                    ->where($key, $key)
                    ->sql();
                print_r($sql);
            }
        }

    }
}