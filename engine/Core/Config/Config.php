<?php

namespace Engine\Core\Config;


class Config
{
    public static function item($key, $group = 'main'){

    }

    public static function file($group){
        $path = $_SERVER['DOCUMENT_ROOT'] . '/' . mb_strtolower(ENV) . '/Config/' . $group . '.php';

        if(file_exists($path)){
            $items = 
        }
        else{
            throw new \Exception(
                sprintf('Can not load config from, file <strong>%s</strong> does not exist', $path);
            );
        }

        return false;
    }
}