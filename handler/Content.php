<?php
namespace Handler;
use Core\Query\DataTables;
use Core\Storage\Storage;
use Core\Validator\FormValidator;
use Exception;
use Repository\Category;
use Repository\Post;
use Repository\tag;

class Content {
    public function index()
    {
        viewWithLayout('dashboard', 'dashboard/content/index');
    }

    public function create(){
        $categorys = parseObject(Category::getAllCategory(), 'title');
        $tags = parseObject(Tag::getAllTag(), 'title');

        viewWithLayout('dashboard', 'dashboard/content/create', ['categorys' => $categorys, 'tags' => $tags]);
    }

    public function edit($id){
        $categorys = parseObject(Category::getAllCategory(), 'title');
        $tags = parseObject(Tag::getAllTag(), 'title');
        $post = Post::findPostById($id);

        $tagToPost = Tag::findTagToPost($id);
        $categoryToPost = Category::findCategoryToPost($id);

        viewWithLayout('dashboard', 'dashboard/content/edit', ['categorys' => $categorys, 'tags' => $tags, 'post' => $post, 'tagToPost' => $tagToPost, 'categoryToPost' => $categoryToPost]);
    }

    protected function textToJson($datas){
        $cn = json_decode(fully_decode_html_entities($datas), true);
        return array_map(function($key){
            return $key["value"];
        }, $cn);
    }

    public function store(){
        try {
            FormValidator::validate('title', 'required');
            FormValidator::validate('slug', 'required');
            FormValidator::validate('summary', 'required');
            FormValidator::validate('content', 'required');
            FormValidator::validate('tags', 'required');
            FormValidator::validate('categorys', 'required');
            // If validation passes, process the form
        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
            return redirect('/dashboard/content/create');
        }

        $contents = Post::newPost($_POST);

        if(!isset($contents)){
            $_SESSION['error'] = "gagal menambah data";
            return redirect('/dashboard/content/create');
        }
        
        $categorys = Category::getCategoryBytitle($this->textToJson($_POST['categorys']));
        $tags = Tag::getTagBytitle($this->textToJson($_POST['tags']));

        foreach($categorys as $category){
            Category::addCategoryToPost([
                                'post_id' => $contents,
                                'category_id' => $category->category_id
            ]);
        }

        foreach($tags as $tag){
            Tag::addtagToPost([
                            'post_id' => $contents,
                            'tag_id' => $tag->tag_id
            ]);
        }

        return redirect('/dashboard/content');
    }

    public function getAllContent()
    {
        // Informasi kolom
        $columns = array(
            array( 'db' => 'post_id', 'dt' => 0 ),
            array( 'db' => 'title', 'dt' => 1 ),
            array( 'db' => 'slug', 'dt' => 2 ),
            array( 'db' => 'created_at',
                   'dt' => 3,
                   'formatter' => function( $d, $row ) {
                        return date( 'jS M y', strtotime($d));
                    } ),
            array( 'db' => 'updated_at', 'dt' => 4 ,'formatter' => function( $d, $row ) {
                        return date( 'jS M y', strtotime($d));
                    } )
        );

        // Handle server-side processing
        echo json_encode(DataTables::simple($_GET, 'posts', 'post_id', $columns));
    }

    public function uploadFile(){
        try {
            FormValidator::validate('image.image/jpeg,image/png,image/gif', 'file');
            // If validation passes, process the form
        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
            http_response_code(404);
            return $e->getMessage();
        }

        $storage = new Storage('content/'. user()->id);

        header('Content-Type: application/json; charset=utf-8');
        
        echo json_encode([
            'success' => 1,
            'file' => [
                'url' => url('/'.$storage->saveData($_FILES['image']))
            ]
        ]);
    }

    public function destroy($id){
        $category = Post::deletePost($id);
        if(!isset($category)){
            return "gagal delete data";
        }
        return "berhasil delete data";
    }
}

