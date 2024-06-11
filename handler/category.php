<?php
namespace Handler;
use Core\Query\DataTables;
use Core\Validator\FormValidator;
use Exception;
use Repository\Category as Model;

class Category {
    public function index()
    {
        viewWithLayout('dashboard', 'dashboard/category/index');
    }

    public function create(){
        viewWithLayout('dashboard', 'dashboard/category/create');
    }

    public function store(){
        try {
            FormValidator::validate('title', 'required');
            FormValidator::validate('slug', 'required');
            // If validation passes, process the form
        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
            return redirect('/dashboard/category/create');
        }

        $category = Model::newCategory($_POST);
        if(!isset($category)){
            $_SESSION['error'] = "gagal menambah data";
            return redirect('/dashboard/category/create');
        }
        return redirect('/dashboard/category');
    }

    public function edit($id){
        $category = Model::findCategoryById($id);

        viewWithLayout('dashboard', 'dashboard/category/edit', ['id' => $id, 'category' => $category]);
    }

    public function update($id){
        try {
            FormValidator::validate('title', 'required');
            FormValidator::validate('slug', 'required');
            // If validation passes, process the form
        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
            return redirect('/dashboard/category/edit?id='. $id);
        }

        $category = Model::updateCategory($id,$_POST);
        if(!isset($category)){
            $_SESSION['error'] = "gagal menambah data";
            return redirect('/dashboard/category/edit?id='. $id);
        }
        return redirect('/dashboard/category');
    }

    public function destroy($id){
        $category = Model::deleteCategory($id);
        if(!isset($category)){
            return "gagal delete data";
        }
        return "berhasil delete data";
    }

    public function getAllCategory()
    {
        // Informasi kolom
        $columns = array(
            array( 'db' => 'category_id', 'dt' => 0 ),
            array( 'db' => 'title', 'dt' => 1 ),
            array( 'db' => 'slug', 'dt' => 2 ),
            array( 'db' => 'content', 'dt' => 3 ),
            array( 'db' => 'created_at',
                   'dt' => 4,
                   'formatter' => function( $d, $row ) {
                        return date( 'jS M y', strtotime($d));
                    } ),
            array( 'db' => 'updated_at', 'dt' => 5 ,'formatter' => function( $d, $row ) {
                        return date( 'jS M y', strtotime($d));
                    } )
        );

        // Handle server-side processing
        echo json_encode(DataTables::simple($_GET, 'categorys', 'category_id', $columns));
    }
}

