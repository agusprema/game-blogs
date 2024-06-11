<?php
namespace Handler;
use Core\Auth\Auth;
class Home {
    public function index()
    {
        $user = Auth::user();
        
        masterView('index', ['user' => $user]);
    }

    public function test($slug)
    {
        $user = Auth::user();
        var_dump($slug);
        masterView('index', ['user' => $user]);
    }
}

