<?php

namespace Engine\Core\Auth;

use Engine\Helper\Cookie;


class Auth implements AuthInterface
{
    protected $authorized = false;
    protected $hash_user;

    /**
     * @return bool
     */
    public function authorized(){
        return $this->authorized;
    }

    public function setAuthorized(){
        $this->authorized = true;
    }

    /**
     * @return mixed
     */
    public function hashUser(){
        return Cookie::get('auth_user');
    }

    /**
     * @param $user
     */
    public function authorize($user){
        Cookie::set('auth_authorized', true);
        Cookie::set('auth_user', $user);

//        $this->authorized = true;
//        $this->hash_user  = $user;
    }

    /**
     * @return void
     */
    public function unAuthorize(){
        Cookie::delete('auth_authorized');
        Cookie::delete('auth_user');

//        $this->authorized = false;
//        $this->hash_user  = null;
    }

    /**
     * @return int
     */
    public static function salt(){
        return (string) rand(10000000, 99999999);
    }

    /**
     * @param $password
     * @param string $salt
     * @return string
     */
    public static function encryptPassword($password, $salt = ''){
        return hash('sha256', $password . $salt);
    }



}