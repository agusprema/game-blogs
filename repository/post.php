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
                                'content' => isset($data['content']) ? $data['content'] : null
                            ])
                            ->build();
        return $query;
    }

    public static function updatePost($id,$data){

        $queryBuilder = new QueryBuilder();
        $query = $queryBuilder->table('posts')
                            ->update([
                                'title' => $data['title'],
                                'slug' => $data['slug'],
                                'content' => isset($data['content']) ? $data['content'] : null
                            ])
                            ->where('Post_id', '=', $id)
                            ->build();
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