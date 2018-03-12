<?php

namespace Engine;

use Engine\DI\DI;

class Load
{
    const MASK_MODEL_ENTITY     = '\%s\Model\%s\%s';
    const MASK_MODEL_REPOSITORY = '\%s\Model\%s\%sRepository';

    public $di;

    public function __construct(DI $di)
    {
        $this->di = $di;
    }

    /**
     * @param $modelName
     * @param bool $modelDir
     * @return \stdClass
     */
    public function model($modelName, $modelDir = false)
    {
        $modelName  = ucfirst($modelName);
        $model      = new \stdClass();
        $modelDir   = $modelDir ? $modelDir : $modelName;

        $namespaceModel = sprintf(
            self::MASK_MODEL_REPOSITORY,
            ENV, $modelDir, $modelName
        );

        $isClassModel = class_exists($namespaceModel);

        if($isClassModel) {
            $this->di->push('model', [
                'key'   => $modelName,
                'value' => new $namespaceModel($this->di)
            ]);
        }

        return $isClassModel;
    }

}