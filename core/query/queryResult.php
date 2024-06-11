<?php
namespace Core\Query;
use Core\Query\QueryResultItem;
use Exception;

class QueryResult
{
    private $data;
    private $count;

    public function __construct($data, $count)
    {
        $this->data = $data;
        
        $this->count = $count;
    }

    public function __get($key)
    {
        return isset($this->data[$key]) ? $this->data[$key] : null;
    }

    public function count()
    {
        return $this->count;
    }

    public function get()
    {
        return array_map(function($item) {
            return new QueryResultItem($item);
        }, $this->data);
    }
}