<?php
namespace Admin\Model\Plugin;

use Engine\Model;

class PluginRepository extends Model
{
    public function getPlugins()
    {
        $sql = $this->queryBuilder
            ->select()
            ->from('plugin')
            ->sql();

        $query = $this->db->query($sql);

        return $query;
    }

    public function getActivePlugins()
    {
        $sql = $this->queryBuilder
            ->select()
            ->from('plugin')
            ->where('is_active', 1)
            ->sql();

        $query = $this->db->query($sql, $this->queryBuilder->values);

        return $query;
    }

    public function addPlugin($directory)
    {
        $plugin = new Plugin();
        $plugin->setDirectory($directory);

        return $plugin->save();
    }

    public function activatePlugin($id, $active)
    {
        $plugin = new Plugin($id);
        $plugin->setIsActive($active);

        return $plugin->save();
    }

    public function isInstallPlugin($directory)
    {
        $query = $this->db->query(
            $this->queryBuilder
                ->select('COUNT(id) as count')
                ->from('plugin')
                ->where('directory', $directory)
                ->limit(1)
                ->sql(),
            $this->queryBuilder->values
        );

        if ($query[0]->count > 0) {
            return true;
        }

        return false;
    }

    public function isActivePlugin($directory)
    {
        $query = $this->db->query(
            $this->queryBuilder
                ->select('COUNT(id) as count')
                ->from('plugin')
                ->where('directory', $directory)
                ->where('is_active', 1)
                ->limit(1)
            ->sql(),
            $this->queryBuilder->values
        );

        if ($query[0]->count > 0) {
            return true;
        }

        return false;
    }
}