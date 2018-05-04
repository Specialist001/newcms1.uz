<?php
namespace Limber\Mokko;

class SprintfEngine extends Engine
{
    public function render($template, $value)
    {
        if (strstr($template, '%') == false) {
            return parent::render($template, $value);
        }

        $result = $template;
        if (!is_array($value)) {
            $value = ['' => $value];
        }

        foreach (new NestedKeyIterator(new RecursiveArrayOnlyIterator($value)) as $key => $value) {
            $pattern = "/" . $this->left . $key . "(%[^" . $this->right . "]+)?" . $this->right . "/";
            preg_match_all($pattern, $template, $matches);

            $substs = array_map(function ($match) use ($value) {
                return $match !== '' ? sprintf($match, $value) : $value;
            }, $matches[1]);

            $result = str_replace($matches[0], $substs, $result);
        }

        return $result;
    }
}