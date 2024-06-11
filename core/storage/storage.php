<?php

namespace Core\Storage;

Class Storage{
    public $root = 'storage/';
    public $directory;

    function __construct($directory)
    {
        $this->directory = $this->root.$directory;

        if (!is_dir($this->root)) {
            mkdir($this->root, 0777, true);
        }

        if (!is_dir($this->directory)) {
            mkdir($this->directory, 0777, true);
        }
    }

    private function getName($length = 10){
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    private function getExtension($target_file){
        return strtolower(pathinfo($target_file['name'],PATHINFO_EXTENSION));
    }

    public function saveData($data) {
        $filename = $this->getName();
        $filepath = $this->directory . '/'. $filename .'.'. $this->getExtension($data);

        if (move_uploaded_file($data["tmp_name"],$filepath)) {
            return $filepath;
        }

        return false;
    }

    public function readData($filename) {
        $filepath = $this->directory. $filename;

        if (file_exists($filepath)) {
            return file_get_contents($filepath);
        }

        return null;
    }

    public function deleteData($filename) {
        $filepath = $this->directory. $filename;

        if (file_exists($filepath)) {
            return unlink($filepath);
        }

        return false;
    }

    public function listFiles() {
        return array_diff(scandir($this->directory), ['..', '.']);
    }
}