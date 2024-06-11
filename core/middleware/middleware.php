<?php
use Middleware\Handdle;

function registerMiddleware($middlewares){
    require_once BASE_PROJECT_PATH . '/middleware/handdle.php';
    if(isset($middlewares)){
        $m = explode("|", $middlewares);

        foreach ($m as $middleware){
            $mm = explode('.', $middleware);
            $mc = $mm[0];

            if(!method_exists('Middleware\\Handdle',$mc)){
                throw new Exception("{$mc} is not found");
            }

            try {
                if(isset($mm[1])){
                    Handdle::$mc($mm[1]);
                } else {
                    Handdle::$mc();
                }
                
            } catch (Exception $e) {
                echo 'Caught exception: ',  $e->getMessage(), "\n";
            }
        }
    }
}

