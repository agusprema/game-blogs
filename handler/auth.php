<?php
namespace Handler;
use Core\Auth\Auth as Authentication;
use Repository\Users;
use Core\Validator\FormValidator;
use Exception;
use Core\Storage\Storage;

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

    public function profile(){
        masterView('profile');
    }

    public function updateProfile(){
        $user = user();
        try {
            FormValidator::validate('profile.image/jpeg,image/png,image/gif', 'file');
            // If validation passes, process the form
        } catch (Exception $e) {
            $_SESSION['error']['profile'] = $e->getMessage();
            return redirect('/user/profile');
        }

        if(!empty($_FILES['profile']['name'])){
            $_POST['profile'] = (new Storage('profile'))->saveData($_FILES['profile']);
        }

        $sad = Users::updateProfileUserByID($user->id, $_POST);

        return redirect('/user/profile');
    }

    public function dataProfile(){
        $user = user();
        try {
            FormValidator::validate('name', 'required');
            // If validation passes, process the form
        } catch (Exception $e) {
            $_SESSION['error']['data'] = $e->getMessage();
            return redirect('/user/profile');
        }

        $sad = Users::updateProfileNameUserByID($user->id, $_POST);

        return redirect('/user/profile');
    }

    public function password(){
        $user = user();
        try {
            FormValidator::validate('oldpassword', 'required');
            FormValidator::validate('password', 'required');
            // If validation passes, process the form
        } catch (Exception $e) {
            $_SESSION['error']['password'] = $e->getMessage();
            return redirect('/user/profile');
        }

        if(!password_verify($_POST['oldpassword'], $user->password)){
            $_SESSION['error']['password'] = "password anda salah!";
            return redirect('/user/profile');
        }

        $sad = Users::updatePasswordUserByID($user->id, $_POST);

        return redirect('/user/profile');
    }
}