<?php
namespace Modules\Backend\Service\CustomField;

use Limber;
use Modules\Backend\Model\CustomFieldGroup as CustomFieldGroupModel;
use Modules\Backend\Model\CustomField as CustomFieldModel;

/**
 * Class CustomFieldService
 * @package Modules\Backend\Service\CustomField
 */
class CustomFieldService
{
    /**
     * @param Modules\Backend\Model\Page $page
     * @return array
     */

    public function getResourceFields(Modules\Backend\Model\Resource $resource): array
    {
        $resourceFields = [];
        $groupIds = [];

        $customFieldGroupModel = new CustomFieldGroupModel();
        $customFieldModel = new CustomFieldModel();

        $listGroup = $customFieldGroupModel->getFieldGroupByResource($resource);

        foreach ($listGroup as $group) {
            $resourceFields[$group->id]['group'] = $group;
            $groupIds[] = $group->id;
        }

        if (empty($groupIds)) return $resourceFields;

        $listFields = $customFieldModel->getListFieldsByGroupIds($resource->id, $groupIds);

        foreach ($listFields as $field) {
            $html = Limber\CustomField\CustomField::make($field);
            $resourceFields[$field->group_id]['fields'][$field->id] = $field;
            $resourceFields[$field->group_id]['fields'][$field->id]->html = $html;
        }

        return $resourceFields;
    }
}