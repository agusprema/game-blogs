<?php
namespace Handler;
use Core\Auth\Auth as Authentication;
use Repository\Users;
use Core\Validator\FormValidator;
use Exception;

Class Auth {
    public function index(){
        viewWithLayout('basic','login');
    }

    public function login(){
        return Authentication::authenticaton($_POST);
    }

    public function register(){
        viewWithLayout('basic','register');
    }

    public function storeRegister(){
        try {
            FormValidator::validate('email.users.email', 'required|unique');
            FormValidator::validate('name', 'required');
            FormValidator::validate('password', 'required');
            // If validation passes, process the form
        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
            return redirect('/register');
        }

        $user = Users::newUser($_POST);
        if(!isset($user)){
            $_SESSION['error'] = "gagal menambah data";
            return redirect('/register');
        }
        return redirect('/login');
    }

    public function logoutPage(){
        Authentication::logout();
        return redirect('/login');
    }
}