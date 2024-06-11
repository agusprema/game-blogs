<?php
namespace Handler;
use Core\Query\DataTables;
use Core\Validator\FormValidator;
use Exception;
use Repository\Tag as Model;

class Tag {
    public function index()
    {
        viewWithLayout('dashboard', 'dashboard/tag/index');
    }

    public function create(){
        viewWithLayout('dashboard', 'dashboard/tag/create');
    }

    public function store(){
        try {
            FormValidator::validate('title', 'required');
            FormValidator::validate('slug', 'required');
            // If validation passes, process the form
        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
            return redirect('/dashboard/tag/create');
        }

        $tag = Model::newTag($_POST);
        if(!isset($tag)){
            $_SESSION['error'] = "gagal menambah data";
            return redirect('/dashboard/tag/create');
        }
        return redirect('/dashboard/tag');
    }

    public function edit($id){
        $tag = Model::findTagById($id);
        
        viewWithLayout('dashboard', 'dashboard/tag/edit', ['id' => $id, 'tag' => $tag]);
    }

    public function update($id){
        try {
            FormValidator::validate('title', 'required');
            FormValidator::validate('slug', 'required');
            // If validation passes, process the form
        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
            return redirect('/dashboard/tag/edit?id='. $id);
        }

        $tag = Model::updateTag($id,$_POST);
        if(!isset($tag)){
            $_SESSION['error'] = "gagal menambah data";
            return redirect('/dashboard/tag/edit?id='. $id);
        }
        return redirect('/dashboard/tag');
    }

    public function destroy($id){
        $tag = Model::deleteTag($id);
        if(!isset($tag)){
            return "gagal delete data";
        }
        return "berhasil delete data";
    }

    public function getAllTag()
    {
        // Informasi kolom
        $columns = array(
            array( 'db' => 'tag_id', 'dt' => 0 ),
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
        echo json_encode(DataTables::simple($_GET, 'tags', 'tag_id', $columns));
    }
}

