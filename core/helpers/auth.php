<?php
use Repository\Users;

if(!function_exists('user')){
    function user($id = ''){
        $userID = !empty($id) ? $id : (isset($_SESSION['auth']) ? $_SESSION['auth'] : null);

        if ($userID) {
            return Users::findUserByID($userID);
        }

        return null;
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