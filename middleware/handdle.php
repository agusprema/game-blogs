<?php
namespace Middleware;

use Core\Auth\Auth;

Class Handdle{
    public static function auth(){
        if(!Auth::check_auth()){
            return redirect('/login');
        }
    }

    public static function guest(){
        if(Auth::check_auth()){
            return redirect('/');
        }
    }

    public static function role($role){
        if(!Auth::check_role($role)){
            return redirect('/');
        }
    }
}
