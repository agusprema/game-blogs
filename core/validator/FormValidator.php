<?php
namespace Core\Validator;
use Exception;
use Core\Query\QueryBuilder;

class FormValidator {
    private $data;
    private $requiredFields = [];
    
    public function __construct() {
        foreach($_POST as $key => $data){
            $_POST[$key] = htmlspecialchars($data);
        }

        $this->data = $_POST;
    }

    public static function validate($field, $rules) {
        // Common validation rules
        $rl = explode("|", $rules);
        $fd = explode('.', $field);

        foreach($rl as $rule){
            (new self)->{$rule}($fd);
        }
        // Add more validation methods as needed
    }

    private function required($field) {
        // Check if required fields are present
        if (empty($this->data[$field[0]])) {
            throw new Exception("{$field[0]} is required.");
        }
    }

    private function file($field) {
        $fileMimeType = $_FILES[$field[0]]["type"];
        $accMimeType = explode(',', $field[1]);

        if (!in_array($fileMimeType, $accMimeType)) {
            throw new Exception("{$field[0]} most type ". implode(',', $accMimeType));
        }
    }

    private function email($field) {
        // Check if email field is in a valid format
        if (!filter_var($this->data[$field[0]], FILTER_VALIDATE_EMAIL)) {
            throw new Exception("{$field[0]} is Invalid email format.");
        }
    }

    private function unique($field) {
        // Check if email field is in a valid format
        if($this->findData($field[1], $field[2], $this->data[$field[0]])){
            throw new Exception("{$field[0]} is not uinique.");
        }
    }

    private function findData($table, $column, $data){
        $queryBuilder = new QueryBuilder();
        $query = $queryBuilder->table($table)
                            ->select($column)
                            ->where($column, '=', $data)
                            ->first();

        if(isset($query)){
            return true;
        }

        return false;
    }

}