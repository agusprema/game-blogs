<?php

return [
    ["GET /", "Home@index" ,"auth"],
    ["GET /blog/:slug", "Home@test" ,"auth"],




    ["GET /dashboard", "Dashboard@index" ,"auth|role.admin"],


    ["GET /dashboard/content", "Content@index" ,"auth"],
    ["GET /dashboard/content/create", "content@create" ,"auth"],
    ["POST /dashboard/content", "content@store" ,"auth"],
    ["GET /dashboard/content/:id/edit", "content@edit" ,"auth"],
    ["POST /dashboard/content/:id/update", "content@update" ,"auth"],
    ["POST /dashboard/content/:id/destroy", "content@destroy" ,"auth"],


    ["GET /dashboard/user", "User@index" ,"auth|role.admin"],
    ["GET /dashboard/user/create", "User@create" ,"auth|role.admin"],
    ["POST /dashboard/user", "User@store" ,"auth|role.admin"],
    ["GET /dashboard/user/:id/edit", "User@edit" ,"auth|role.admin"],
    ["POST /dashboard/user/:id/update", "User@update" ,"auth|role.admin"],
    ["POST /dashboard/user/:id/destroy", "User@destroy" ,"auth|role.admin"],


    ["GET /dashboard/tag", "Tag@index" ,"auth"],
    ["GET /dashboard/tag/create", "tag@create" ,"auth"],
    ["POST /dashboard/tag", "tag@store" ,"auth"],
    ["GET /dashboard/tag/:id/edit", "tag@edit" ,"auth"],
    ["POST /dashboard/tag/:id/update", "tag@update" ,"auth"],
    ["POST /dashboard/tag/:id/destroy", "tag@destroy" ,"auth"],

    ["GET /dashboard/category", "Category@index" ,"auth"],
    ["GET /dashboard/category/create", "category@create" ,"auth"],
    ["POST /dashboard/category", "category@store" ,"auth"],
    ["GET /dashboard/category/:id/edit", "category@edit" ,"auth"],
    ["POST /dashboard/category/:id/update", "category@update" ,"auth"],
    ["POST /dashboard/category/:id/destroy", "category@destroy" ,"auth"],

    ["GET /v1/api/users", "User@getAllUsers" ,"auth|role.admin"],
    ["GET /v1/api/categorys", "Category@getAllCategory" ,"auth"],
    ["GET /v1/api/tags", "tag@getAllTag" ,"auth"],
    ["GET /v1/api/contents", "Content@getAllContent" ,"auth"],
    ["POST /v1/api/upload-file", "Content@uploadFile" ,"auth"],


    ["GET /login", "Auth@index" ,"guest"],
    ["POST /login", "Auth@login" ,"guest"],
    ["GET /logout", "Auth@logoutPage" ,"auth"],
    ["GET /register", "Auth@register" ,"guest"],
    ["POST /register", "Auth@storeRegister" ,"guest"],
];
