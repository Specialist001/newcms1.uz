<?php
namespace Limber\Mokko;

class Engine extends AbstractEngine
{
    public function render($template, $value)
    {
        $result = $template;
        if (!is_array($value)) {
            $value = ['' => $value];
        }
        foreach (new NestedKeyIterator(new RecursiveArrayOnlyIterator($value)) as $key => $value) {
            $result = str_replace($this->left . $key . $this->right, $value, $result);
        }
        return $result;
    }
}