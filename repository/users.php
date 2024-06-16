<?php
namespace Repository;

use Core\Query\QueryBuilder;

class Users{
    public static function findUserByEmail($email){
        $queryBuilder = new QueryBuilder();
        $query = $queryBuilder->table('users')
                            ->select('*')
                            ->where('email', '=', $email)
                            ->first();

        return $query;
    }

    public static function allUsers(){
        $queryBuilder = new QueryBuilder();
        $query = $queryBuilder->table('users')
                            ->select('*')
                            ->build();

        return $query;
    }

    public static function findUserById($id){
        $queryBuilder = new QueryBuilder();
        $query = $queryBuilder->table('users')
                            ->select('*')
                            ->where('id', '=', $id)
                            ->first();
        return $query;
    }

    public static function newUser($data){

        $queryBuilder = new QueryBuilder();
        $query = $queryBuilder->table('users')
                            ->create([
                                'email' => $data['email'],
                                'name' => $data['name'],
                                'password' => password_hash($data['password'], PASSWORD_BCRYPT),
                                'profile'  => 'profile/avatar.svg',
                                'role'     => isset($data['role']) ? $data['role'] : 'user'
                            ])
                            ->build();
        return $query;
    }

    public static function updateUserByID($id, $data){

        $queryBuilder = new QueryBuilder();
        $query = $queryBuilder->table('users')
                            ->update([
                                'name' => $data['name'],
                                'role' => $data['role']
                            ])
                            ->where('id', '=', $id)
                            ->build();
        return $query;
    }

    public static function updatePasswordUserByID($id, $data){

        $queryBuilder = new QueryBuilder();
        $query = $queryBuilder->table('users')
                            ->update([
                                'password' => password_hash($data['password'], PASSWORD_BCRYPT),
                            ])
                            ->where('id', '=', $id)
                            ->build();
        return $query;
    }

    public static function updateProfileUserByID($id, $data){

        $queryBuilder = new QueryBuilder();
        $query = $queryBuilder->table('users')
                            ->update([
                                'profile'  => $data['profile'],
                            ])
                            ->where('id', '=', $id)
                            ->build();
        return $query;
    }

    public static function updateProfileNameUserByID($id, $data){

        $queryBuilder = new QueryBuilder();
        $query = $queryBuilder->table('users')
                            ->update([
                                'name'  => $data['name'],
                            ])
                            ->where('id', '=', $id)
                            ->build();
        return $query;
    }

    public static function deleteUser($id){
        $queryBuilder = new QueryBuilder();
        $query = $queryBuilder->table('users')
                            ->delete()
                            ->where('id', '=', $id)
                            ->build();
        return $query;
    }
}