<?php

namespace Engine;

abstract class Plugin
{
    abstract public function init();
    abstract public function activate();
    abstract public function unActivate();
    abstract public function install();
    abstract public function delete();
}