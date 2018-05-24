<?php
namespace Modules\Admin\Service\CustomField;

use Limber;
use Modules\Admin\Model\CustomFieldGroup as CustomFieldGroupModel;
use Modules\Admin\Model\CustomField as CustomFieldModel;

/**
 * Class CustomFieldService
 * @package Modules\Admin\Service\CustomField
 */
class CustomFieldService
{
    /**
     * @param Modules\Admin\Model\Page $page
     * @return array
     */

    public function getResourceFields(Modules\Admin\Model\Resource $resource): array
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