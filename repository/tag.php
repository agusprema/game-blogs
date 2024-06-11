<?php
namespace Repository;

use Core\Query\QueryBuilder;

class tag{
    public static function newTag($data){

        $queryBuilder = new QueryBuilder();
        $query = $queryBuilder->table('tags')
                            ->create([
                                'title' => $data['title'],
                                'slug' => $data['slug'],
                                'content' => isset($data['content']) ? $data['content'] : null
                            ])
                            ->build();
        return $query;
    }

    public static function updateTag($id,$data){

        $queryBuilder = new QueryBuilder();
        $query = $queryBuilder->table('tags')
                            ->update([
                                'title' => $data['title'],
                                'slug' => $data['slug'],
                                'content' => isset($data['content']) ? $data['content'] : null
                            ])
                            ->where('tag_id', '=', $id)
                            ->build();
        return $query;
    }

    public static function findtagById($id){
        $queryBuilder = new QueryBuilder();
        $query = $queryBuilder->table('tags')
                            ->select('*')
                            ->where('tag_id', '=', $id)
                            ->first();
        return $query;
    }

    public static function addTagToPost($data){
        $queryBuilder = new QueryBuilder(false);
        $query = $queryBuilder->table('post_tags')
                            ->create([
                                'post_id' => $data['post_id'],
                                'tag_id' => $data['tag_id']
                            ])
                            ->build();
        return $query;
    }

    public static function findTagToPost($id){
        $postToTag = (new QueryBuilder())->table('post_tags')
                            ->select('tag_id')
                            ->where('post_id', '=', $id)
                            ->build();
        
        $tags = (new QueryBuilder())->table('tags')
                                    ->select('title')
                                    ->whereIn('tag_id',parseObject($postToTag, 'tag_id'))
                                    ->build();
        return $tags;
    }

    public static function getTagBytitle($values){
        $queryBuilder = new QueryBuilder();
        $query = $queryBuilder->table('tags')
                            ->select('tag_id')
                            ->whereIn('title', $values)
                            ->build();
        return $query;
    }

    public static function getAllTag(){
        $queryBuilder = new QueryBuilder();
        $query = $queryBuilder->table('tags')
                            ->select('*')
                            ->build();
        return $query;
    }

    public static function deleteTag($id){
        $queryBuilder = new QueryBuilder();
        $query = $queryBuilder->table('tags')
                            ->delete()
                            ->where('tag_id', '=', $id)
                            ->build();
        return $query;
    }
}