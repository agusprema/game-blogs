<?php
namespace Repository;

use Core\Query\QueryBuilder;

class Post{
    public static function newPost($data){

        $queryBuilder = new QueryBuilder();
        $query = $queryBuilder->table('posts')
                            ->create([
                                'user_id' => user()->id,
                                'title' => $data['title'],
                                'slug' => $data['slug'],
                                'summary' => $data['summary'],
                                'thumbnail' => $data['thumbnail'],
                                'content' => isset($data['content']) ? $data['content'] : null
                            ])
                            ->build();
        return $query;
    }

    public static function getPostBySlug($slug){
        $queryBuilder = new QueryBuilder();
        $query = $queryBuilder->table('posts')
                            ->select("*")
                            ->where('slug', '=', $slug)
                            ->first();
        return $query;
    }

    public static function getPostByTag($tag, $page){
        $queryBuilder = new QueryBuilder();
        $query = $queryBuilder->table('posts')
                            ->select("*")
                            ->orderBy('updated_at', 'DESC')
                            ->whereIn('post_id', $tag)
                            ->paginate(10, $page);
        return $query;
    }

    public static function getPostByCategory($category, $page){
        $queryBuilder = new QueryBuilder();
        $query = $queryBuilder->table('posts')
                            ->select("*")
                            ->orderBy('updated_at', 'DESC')
                            ->whereIn('post_id', $category)
                            ->paginate(10, $page);
        return $query;
    }

    public static function updatePost($id,$data){
        $datas = [
            'title' => $data['title'],
            'slug' => $data['slug'],
            'summary' => $data['summary'],
            'content' => isset($data['content']) ? $data['content'] : null
        ];
        
        if(isset($data['thumbnail'])){
            $datas['thumbnail'] = $data['thumbnail'];
        }

        $queryBuilder = new QueryBuilder();
        $query = $queryBuilder->table('posts')
                            ->update($datas)
                            ->where('Post_id', '=', $id)
                            ->build();
        return $query;
    }

    public static function getPosts($search = '', $page = 1){
        $queryBuilder = new QueryBuilder();
        $query = $queryBuilder->table('posts')
                            ->select('*')
                            ->orderBy('updated_at', 'DESC')
                            ->where('title', 'LIKE', '%'.$search.'%')
                            ->paginate(5, $page);
        return $query;
    }

    public static function findPostById($id){
        $queryBuilder = new QueryBuilder();
        $query = $queryBuilder->table('posts')
                            ->select('*')
                            ->where('post_id', '=', $id)
                            ->first();
        return $query;
    }

    public static function deletePost($id){
        $tagToPost = (new QueryBuilder())->table('post_tags')
                            ->delete()
                            ->where('post_id', '=', $id)
                            ->build();
        $categoryToPost = (new QueryBuilder())->table('post_categorys')
                            ->delete()
                            ->where('post_id', '=', $id)
                            ->build();
        $post = (new QueryBuilder())->table('posts')
                            ->delete()
                            ->where('post_id', '=', $id)
                            ->build();
        return $post;
    }
}