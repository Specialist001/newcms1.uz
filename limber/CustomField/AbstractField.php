<?php
namespace Limber\CustomField;

use Limber;

abstract class AbstractField
{
    /**
     * @var Limber\CustomField\Params\CustomFieldParams
     */
    protected $fieldData;
    /**
     * @var array
     */
    protected $fieldDataArray;
    public function __construct(array $params)
    {
        $this->setFieldData(
            new Params\CustomFieldParams($params)
        );
        $this->fieldDataArray = $params;
    }
    /**
     * @return Params\CustomFieldParams
     */
    public function getFieldData(): Params\CustomFieldParams
    {
        return $this->fieldData;
    }
    /**
     * @param Params\CustomFieldParams $fieldData
     */
    public function setFieldData(Params\CustomFieldParams $fieldData)
    {
        $this->fieldData = $fieldData;
    }
    /**
     * @return array
     */
    public function dataToArray()
    {
        return $this->fieldDataArray;
    }
    /**
     * @return string
     */
    abstract protected function buildTemplate();
}