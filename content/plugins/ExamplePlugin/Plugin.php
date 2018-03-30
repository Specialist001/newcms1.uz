<?php

namespace Plugin\ExamplePlugin;

//use Engine\Plugin;

class Plugin extends \Engine\Plugin
{

    public function details()
    {
        return [
            'name'        => 'Plugin Demo',
            'description' => 'Demo plugin',
            'author'      => 'Specialist001',
            'icon'      => 'icon-leaf'
        ];
    }

    public function init()
    {
        // TODO: Implement init() method.
    }

    public function install()
    {

    }

    public function delete()
    {

    }
}