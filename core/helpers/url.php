<?php

if(!function_exists('url')){
    function url($url)
    {
        if ($url == '/') {
            $url = '';
        }
        return BASE_URL . $url;
    }
}

if(!function_exists('redirect')){
    function redirect($url)
    {
        header("Location: " . url($url));
        die();
    }
}


if(!function_exists('is_route')){
    function is_route($urls,$not_active = false, $active = true){
        foreach((array) $urls as $key => $value) {
            if($value == $_SERVER['REQUEST_URI']){
                return $active;
            }
        }

        return $not_active;
    }
}