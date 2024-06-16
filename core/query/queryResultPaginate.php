<?php
namespace Core\Query;
use Core\Query\QueryResultItem;
use Exception;

class queryResultPaginate
{
    private $data;
    private $count;
    private $perPage;
    private $currentPage;

    public function __construct($data, $count, $perPage = 0, $currentPage = 0)
    {
        
        $this->data = $data;
        
        $this->count = $count;
        $this->perPage = $perPage;
        $this->currentPage = $currentPage;
    }

    public function __get($key)
    {
        return isset($this->data[$key]) ? $this->data[$key] : null;
    }

    public function count()
    {
        return $this->count;
    }

    public function perPage()
    {
        return $this->perPage;
    }

    public function currentPage()
    {
        return $this->currentPage;
    }

    public function totalPages()
    {
        return ceil($this->count / $this->perPage);
    }

    public function items()
    {
        return $this->data;
    }
}