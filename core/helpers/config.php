<?php
if (!function_exists('config')) {
function config($config){
    $configs = require __DIR__ . '/../../config.php';
    $keys = explode('.', $config);
    $value = $configs;
    
    foreach ($keys as $key) {
        if (isset($value[$key])) {
            $value = $value[$key];
        } else {
            return '';
        }
    }

    return $value;
}
}