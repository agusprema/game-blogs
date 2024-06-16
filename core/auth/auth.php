<?php
namespace Core\Auth;

use Repository\Users;

class Auth {
    public static function authenticaton($data){
        // Check the User by email
        $user = Users::findUserByEmail($data['email']);

        //check user is avaible
        if(!isset($user)){
            $_SESSION['error'] = "email atau password anda salah!";
            return redirect('/login');
        }

        // verify the password
        if(!password_verify($data['password'], $user->password)){
            $_SESSION['error'] = "email atau password anda salah!";
            return redirect('/login');
        }

        $_SESSION['auth'] = $user->id;
        return redirect('/');
    }

    public static function user($id = ''){
        $userID = !empty($id) ? $id : (isset($_SESSION['auth']) ? $_SESSION['auth'] : null);

        if ($userID) {
            return Users::findUserByID($userID);
        }

        return null;
    }

    public static function check_role($role){
        if(self::user()->role === $role || self::user()->role === 'admin'){
            return true;
        }

        return false;
    }

    public static function logout(){
        return $_SESSION['auth'] = null;
    }

    public static function check_auth(){
        if(isset($_SESSION['auth'])){
            return true;
        }

        return false;
    }
}
