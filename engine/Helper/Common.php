<?php
/**
 * Created by PhpStorm.
 * User: Bobur
 * Date: 21.02.2018
 * Time: 14:14
 */

namespace Engine\Helper;


class Common
{
    /**
     * @return bool
     */
    function isPost(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            return true;
        }

        return false;
    }

    /**
     * @return mixed
     */
    function getMethod(){
        return $_SERVER['REQUEST_METHOD'];
    }

    /**
     * @return bool|string
     */
    function getPathUri(){
        $pathUrl = $_SERVER['REQUEST_URI'];

        if($position = strpos($pathUrl, '?')){
            $pathUrl = substr($pathUrl, 0, $position);
        }

        return $pathUrl;
    }



}

