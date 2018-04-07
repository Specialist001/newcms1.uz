<?php
namespace Plugin\ExamplePlugin;

class Plugin extends \Engine\Plugin
{

    public function details()
    {
        return [
            'name'        => 'Provider Demo',
            'description' => 'Demo plugin',
            'author'      => 'Specialist001',
            'icon'      => 'icon-leaf'
        ];
    }

    public function init()
    {
        // TODO: Implement init() method.
    }
}