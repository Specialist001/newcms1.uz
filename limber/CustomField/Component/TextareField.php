<?php
namespace Limber\CustomField\Component;

use Limber;
use Limber\CustomField;
use stdClass;

class TextareField extends CustomField\AbstractField
{
    public function __construct(stdClass $field)
    {
        parent::__construct((array) $field);
    }

    public function buildTemplate(): string
    {
        $mokko = new Limber\Mokko\Engine();

        $template = '<div class="field">
            <label>{{label}}</label>
            <textarea name="fields[{{id}}]" id="field_{{id}}">{{value}}</textarea>
        </div>';

        return $mokko->render($template, $this->dataToArray());
    }
}