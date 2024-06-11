<?php
namespace Handler;

class Dashboard {
    public function index()
    {
        viewWithLayout('dashboard', 'dashboard/index');
    }
}

