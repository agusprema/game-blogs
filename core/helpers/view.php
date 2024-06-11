<?php

function view($name, $v = [])
{
    if (count($v) > 0) {
        extract($v);
    }
    include VIEW_PATH . $name . ".php";
}

function viewWithLayout($layout, $inc, $v = []){
    view('layout/'. $layout, ['inc' => $inc, 'v' => $v]);
}

function masterView($inc, $v = [])
{
    view('layout/master', ['inc' => $inc, 'v' => $v]);
}

function components($inc, $v = []){
    view('components/'. $inc, $v);
}
