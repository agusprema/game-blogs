<?php

// Autoload dan konfigurasi
require_once "vendor/autoload.php";
require_once "core/helpers/config.php";

// Konstanta proyek
define('BASE_PROJECT_PATH', config('base_project_path'));
define('BASE_URL', config('base_url'));
define('VIEW_PATH', BASE_PROJECT_PATH . config('view_path'));

// Memulai sesi
session_start();

// Memuat helper dan middleware
$helpers = [
    "/core/helpers/dd.php",
    "/core/helpers/asset.php",
    "/core/helpers/url.php",
    "/core/helpers/route.php",
    "/core/helpers/view.php",
    "/core/helpers/storage.php",
    "/core/helpers/auth.php",
    "/core/helpers/misc.php",
    "/core/middleware/middleware.php",
];

foreach ($helpers as $helper) {
    require_once BASE_PROJECT_PATH . $helper;
}

// Pendaftaran route
$routesMap = registerRoute(BASE_PROJECT_PATH . "/routes/web.php");
handleRequest($routesMap);

// Membersihkan pesan kesalahan sesi
if (isset($_SESSION['error'])) {
    unset($_SESSION['error']);
}

?>
