<?php
namespace Handler;
use Repository\Post;
use Core\Editor\Parser;
use Repository\tag;
use Repository\Category;

class Home {
    public function index()
    {
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $search = isset($_GET['s']) ? $_GET['s'] : '';
        $posts = Post::getPosts($search, $page);

        masterView('index', ['posts' => $posts]);
    }

    public function categoryList(){
        $categorys = Category::getAllCategory();
        masterView('category-list', ['categorys' => $categorys]);
    }

    public function tagList(){
        $tags = tag::getAlltag();
        masterView('tag-list', ['tags' => $tags]);
    }

    public function blog($slug){
        $post = Post::getPostBySlug($slug);
        $content = null;
        if(!empty($post)){
         $content = (new Parser())->convert(json_decode(base64_decode(fully_decode_html_entities($post->content)), true));   
        }
        masterView('blog', ['post' => $post, 'content' => $content]);
    }

    public function tag($slug){
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $posts = null;
        $posttag = null;

        $tag = tag::getTagBySlug($slug);

        if(!empty($tag)){
            $posttag = tag::getTagPostBytagId($tag->tag_id);

            if(!empty($posttag)){
                $posts = Post::getPostBytag(parseObject($posttag, 'post_id'), $page);
            }
        }
        
        masterView('tag', ['posts' => $posts]);
    }

    public function category($slug){
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $posts = null;
        $postCategory = null;

        $category = Category::getCategoryBySlug($slug);

        if(!empty($category)){
            $postCategory = Category::getCategoryPostByCategoryId($category->category_id);

            if(!empty($postCategory)){
                $posts = Post::getPostByCategory(parseObject($postCategory, 'post_id'), $page);
            }
        }
        
        masterView('tag', ['posts' => $posts]);
    }
}

