<?php
namespace Repository;

use Core\Query\QueryBuilder;

class Category{
    public static function newCategory($data){

        $queryBuilder = new QueryBuilder();
        $query = $queryBuilder->table('categorys')
                            ->create([
                                'title' => $data['title'],
                                'slug' => $data['slug'],
                                'content' => isset($data['content']) ? $data['content'] : null
                            ])
                            ->build();
        return $query;
    }

    public static function updateCategory($id,$data){

        $queryBuilder = new QueryBuilder();
        $query = $queryBuilder->table('categorys')
                            ->update([
                                'title' => $data['title'],
                                'slug' => $data['slug'],
                                'content' => isset($data['content']) ? $data['content'] : null
                            ])
                            ->where('category_id', '=', $id)
                            ->build();
        return $query;
    }

    public static function findCategoryById($id){
        $queryBuilder = new QueryBuilder();
        $query = $queryBuilder->table('categorys')
                            ->select('*')
                            ->where('category_id', '=', $id)
                            ->first();
        return $query;
    }

    public static function getAllCategory(){
        $queryBuilder = new QueryBuilder();
        $query = $queryBuilder->table('categorys')
                            ->select('*')
                            ->build();
        return $query;
    }

    public static function addCategoryToPost($data){
        $queryBuilder = new QueryBuilder(false);
        $query = $queryBuilder->table('post_categorys')
                            ->create([
                                'post_id' => $data['post_id'],
                                'category_id' => $data['category_id']
                            ])
                            ->build();
        return $query;
    }

    public static function getCategoryBytitle($values){
        $queryBuilder = new QueryBuilder();
        $query = $queryBuilder->table('categorys')
                            ->select('category_id')
                            ->whereIn('title', $values)
                            ->build();
        return $query;
    }

    public static function findCategoryToPost($id){
        $postToCategory = (new QueryBuilder())->table('post_categorys')
                            ->select('category_id')
                            ->where('post_id', '=', $id)
                            ->build();
        
        $categorys = (new QueryBuilder())->table('categorys')
                                    ->select('title')
                                    ->whereIn('category_id',parseObject($postToCategory, 'category_id'))
                                    ->build();
        return $categorys;
    }

    public static function deleteCategory($id){
        $queryBuilder = new QueryBuilder();
        $query = $queryBuilder->table('categorys')
                            ->delete()
                            ->where('category_id', '=', $id)
                            ->build();
        return $query;
    }
}