<?php
namespace Core\DB;

class Connect {
    public function toDB(){
        $host = config('database.hostname');
        $username = config('database.username');
        $password = config('database.password');
        $port = config('database.port');
        $db = config('database.database');

        return mysqli_connect($host, $username, $password, $db, $port);
    }
}