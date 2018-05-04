<?php
namespace Limber\Cms\Admin\Service\CustomField;

use Limber;
use Limber\Cms\Admin\Model\CustomFieldGroup as CustomFieldGroupModel;
use Limber\Cms\Admin\Model\CustomField as CustomFieldModel;

/**
 * Class CustomFieldService
 * @package Limber\Cms\Admin\Service\CustomField
 */
class CustomFieldService
{
    /**
     * @param Limber\Cms\Admin\Model\Page $page
     * @return array
     */

    public function getPageFields(Limber\Cms\Admin\Model\Page $page): array
    {
        $pageFields = [];
        $groupIds = [];

        $customFieldGroupModel = new CustomFieldGroupModel();
        $customFieldModel = new CustomFieldModel();

        $listGroup = $customFieldGroupModel->getFieldGroupByPage($page);

        foreach ($listGroup as $group) {
            $pageFields[$group->id]['group'] = $group;
            $groupIds[] = $group->id;
        }

        if (empty($groupIds)) return $pageFields;

        $listFields = $customFieldModel->getListFieldsByGroupIds($page->id, $groupIds);

        foreach ($listFields as $field) {
            $html = Limber\CustomField\CustomField::make($field);
            $pageFields[$field->group_id]['fields'][$field->id] = $field;
            $pageFields[$field->group_id]['fields'][$field->id]->html = $html;
        }

        return $pageFields;
    }
}