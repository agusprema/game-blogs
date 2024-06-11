<?php
namespace Handler;
use Core\Query\DataTables;
use Repository\Users;
use Core\Validator\FormValidator;
use Exception;

class User {
    public function index()
    {
        viewWithLayout('dashboard', 'dashboard/user/index');
    }

    public function create(){
        viewWithLayout('dashboard', 'dashboard/user/create');
    }

    public function store(){
        try {
            FormValidator::validate('email.users.email', 'required|unique');
            FormValidator::validate('name', 'required');
            FormValidator::validate('password', 'required');
            FormValidator::validate('role', 'required');
            // If validation passes, process the form
        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
            return redirect('/dashboard/user/create');
        }

        $user = Users::newUser($_POST);
        if(!isset($user)){
            $_SESSION['error'] = "gagal menambah data";
            return redirect('/dashboard/user/create');
        }
        return redirect('/dashboard/user');
    }

    public function show(){

    }

    public function edit($id){
        $user = Users::findUserById($id);

        viewWithLayout('dashboard', 'dashboard/user/edit', ['user' => $user, 'id' => $id]);
    }

    public function update($id){
        if($_GET['change'] == 'true'){
            try {
                FormValidator::validate('password', 'required');
                // If validation passes, process the form
            } catch (Exception $e) {
                $_SESSION['error'] = $e->getMessage();
                return redirect('/dashboard/user/edit?id='. $id);
            }

            $user = Users::updatePasswordUserByID($id, $_POST);

            if(!isset($user)){
                $_SESSION['error'] = "gagal update data";
                return redirect('/dashboard/user/edit?id='. $id);
            }
            return redirect('/dashboard/user');
        }
        try {
            FormValidator::validate('email', 'required');
            FormValidator::validate('name', 'required');
            FormValidator::validate('role', 'required');
            // If validation passes, process the form
        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
            return redirect('/dashboard/user/edit?id='. $id);
        }

        $user = Users::updateUserByID($id, $_POST);

        if(!isset($user)){
            $_SESSION['error'] = "gagal update data";
            return redirect('/dashboard/user/edit?id='. $id);
        }
        return redirect('/dashboard/user');
    }

    public function destroy($id){
        $user = Users::deleteUser($id);
        if(!isset($user)){
            return "gagal delete data";
        }
        return "berhasil delete data";
    }

    public function getAllUsers()
    {
        // Informasi kolom
        $columns = array(
            array( 'db' => 'id', 'dt' => 0 ),
            array( 'db' => 'email', 'dt' => 1 ),
            array( 'db' => 'name', 'dt' => 2 ),
            array( 'db' => 'profile', 'dt' => 3 ),
            array( 'db' => 'role', 'dt' => 4 ),
            array( 'db' => 'created_at',
                   'dt' => 5,
                   'formatter' => function( $d, $row ) {
                        return date( 'jS M y', strtotime($d));
                    } ),
            array( 'db' => 'updated_at', 'dt' => 6 ,'formatter' => function( $d, $row ) {
                        return date( 'jS M y', strtotime($d));
                    } )
        );

        // Handle server-side processing
        echo json_encode(DataTables::simple($_GET, 'users', 'id', $columns));
    }
}

