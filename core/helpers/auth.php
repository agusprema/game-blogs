<?php
use Repository\Users;

if(!function_exists('user')){
    function user(){
        return Users::findUserByID($_SESSION['auth']);
    }
}

if(!function_exists('check_auth')){
    function check_auth(){
        if(isset($_SESSION['auth'])){
            return true;
        }

        return false;
    }
}