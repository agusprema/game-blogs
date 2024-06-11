<?php

function dd($d)
{
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($d, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    exit();
}

function fully_decode_html_entities($data) {
    $previous_data = '';
    while ($data !== $previous_data) {
        $previous_data = $data;
        $data = html_entity_decode($data, ENT_QUOTES | ENT_HTML5);
    }
    return $data;
}

function parseObject($datas, $field){
    $result = [];
    foreach($datas as $data){
        $result[] = $data->{$field};
    }
    return $result;
}