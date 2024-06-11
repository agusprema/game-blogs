<?php

// Konfigurasi direktori penyimpanan
$directory = 'storage/';

// Membuat direktori jika belum ada
if (!is_dir($directory)) {
    mkdir($directory, 0777, true);
}

// Fungsi untuk menyimpan data ke file
function saveData($filename, $data) {
    global $directory;
    $filepath = $directory . $filename;

    if (file_put_contents($filepath, $data) !== false) {
        return true;
    }

    return false;
}

// Fungsi untuk membaca data dari file
function readData($filename) {
    global $directory;
    $filepath = $directory . $filename;

    if (file_exists($filepath)) {
        return file_get_contents($filepath);
    }

    return null;
}

// Fungsi untuk menghapus file
function deleteData($filename) {
    global $directory;
    $filepath = $directory . $filename;

    if (file_exists($filepath)) {
        return unlink($filepath);
    }

    return false;
}

// Fungsi untuk menampilkan daftar file di direktori penyimpanan
function listFiles() {
    global $directory;
    return array_diff(scandir($directory), ['..', '.']);
}