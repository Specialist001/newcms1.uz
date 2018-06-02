<?php
namespace Modules\Admin\Controller;

use \View;
use Limber;
use Modules;
use Modules\Admin\Model\ResourceType as ResourceTypeModel;

class CustomFieldController extends AdminController
{
    /**
     * @var Modules\Admin\Model\CustomFieldGroup
     */
    protected $customFieldGroupModel;
    /**
     * @var Modules\Admin\Model\CustomField
     */
    protected $customFieldModel;
    /**
     * CustomFieldController constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->setData('settingsNavItems', \Customize::instance()->getAdminSettingItems());

        $this->customFieldGroupModel = new Modules\Admin\Model\CustomFieldGroup();
        $this->customFieldModel = new Modules\Admin\Model\CustomField();
    }
    /**
     * @return \Limber\Template\View
     */
    public function listingGroup()
    {
        $resourceTypeModel = new ResourceTypeModel();

        $this->setData('groupFieldTypes', $resourceTypeModel->getResourcesType());
        $this->setData('listTemplates', getTypes());
        $this->setData('listGroup', $this->customFieldGroupModel->getListGroup());

        return View::make('custom_fields/list_group', $this->data);
    }
    public function showGroup(int $id)
    {
        $group = $this->customFieldGroupModel->getGroupById($id);
        if (!$group) {
            exit('404');
        }
        $fieldList = $this->customFieldModel->getListFieldsByGroupId($group->id);

        $this->setData('group', $group);
        $this->setData('fieldList', $fieldList);
        $this->setData('fieldTypes', Limber\CustomField\Types\TypeCustomField::ARRAY_FIELD_TYPES);

        return View::make('custom_fields/fields_group', $this->data);
    }
    /**
     * Load options by type entity
     */
    public function loadTemplatesByType()
    {
        $params = Limber\Http\Input::post();
        if (isset($params['type'])) {
            echo \View::make('custom_fields/components/template_options', [
                'listTemplates' => getTypes($params['type'])
            ])->render();
        }
        exit;
    }
    public function loadNewFieldTemplate()
    {
        $params = Limber\Http\Input::post();
        if (isset($params['group_id'])) {
            echo \View::make('custom_fields/components/item_field', [
                'groupId' => $params['group_id'],
                'fieldTypes' => Limber\CustomField\Types\TypeCustomField::ARRAY_FIELD_TYPES
            ])->render();
        }
        exit;
    }
    /**
     * Add field group
     */
    public function addGroup()
    {
        $params = Limber\Http\Input::post();
        $customFieldGroupId = $this->customFieldGroupModel->addGroup([
            'title'    => $params['title'],
            'type'     => $params['type'],
            //'layout'   => $params['layout'],
            'template' => $params['template']
        ]);
        echo $customFieldGroupId;
        exit;
    }
    public function updateFields()
    {
        $params = Limber\Http\Input::post();
        $result = [];
        if (empty($params)) exit;
        foreach ($params['fields'] as $id => $field) {
            $field['group_id'] = $params['group_id'];
            $field['required'] = isset($field['required']) ? 1 : 0;
            $field['status'] = 1;
            $fieldParams = new Limber\CustomField\Params\CustomFieldParams($field);
            if (strlen($fieldParams->getLabel()) < 2) {
                $result['errors'][$id]['label'] = 'error';
            }
            if (strlen($fieldParams->getName()) < 2) {
                $result['errors'][$id]['name'] = 'error';
            }
            if (strlen($fieldParams->getType()) < 2) {
                $result['errors'][$id]['type'] = 'error';
            }
            if (isset($result['errors'])) continue;
            if (is_int($id)) {
                $this->customFieldModel->updateField($id, $fieldParams);
            } else {
                $this->customFieldModel->addField($fieldParams);
            }
        }
        echo json_encode($result);
        exit;
    }
}