<?php

namespace Engine\Core\Template;


class Asset
{
    const EXT_JS     = '.js';
    const EXT_CSS    = '.css';
    const EXT_LESS   = '.less';

    const JS_SCRIPT_MASK = '<script src="%s" type="text/javascript"></script>';
    const CSS_LINK_MASK  = '<link rel="stylesheet" href="%s">';

    public $container = [];

    public function css($link)
    {
        $file = $link . self::EXT_CSS;
        if (is_file($file)) {
            $this->container['css'][] = [
                'file' => $file
            ];
        }
    }

    public function js($link)
    {
        $file = $link .self::EXT_JS;
        if (is_file($file)) {
            $this->container['js'][] = [
                'file' => $file
            ];
        }
    }

    public function render($extension)
    {
        $listAssets = isset($this->container[$extension]) ? $this->container[$extension] : false;

        if ($listAssets) {
            $renderMethod = 'render' .ucfirst($extension);

            $this->{$renderMethod}($listAssets);
        }
    }

    public function renderJs($list)
    {
        foreach ($list as $item) {
            echo sprintf(
                self::JS_SCRIPT_MASK,
                $item['file']
            );
        }
    }

    public function renderCss($list)
    {
        foreach ($list as $item) {
            echo sprintf(
                self::CSS_LINK_MASK,
                $item['file']
            );
        }
    }

    public function __construct()
    {
    }
}