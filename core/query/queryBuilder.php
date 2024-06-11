<?php
namespace Core\Query;
use Core\Query\QueryResult;
use Core\Query\queryResultPaginate;
use Exception;
use Core\DB\Connect;

class QueryBuilder
{
    protected $table;
    protected $fields = [];
    protected $conditions = [];
    protected $orderBy;
    protected $limit;
    protected $data = [];
    protected $conn;
    protected $queryType;
    protected $time;
    protected $offset;
    protected $countData = 0;
    protected $joins = [];

    public function __construct($time = true)
    {
        $this->conn = new Connect();
        $this->conn = $this->conn->toDB();
        $this->time = $time;
    }

    public function table($table)
    {
        $this->table = $table;
        return $this;
    }

    public function select($fields)
    {
        $this->fields = is_array($fields) ? $fields : func_get_args();
        $this->queryType = 'select';
        return $this;
    }

    public function where($column, $operator, $value)
    {
        $this->conditions[] = [$column, $operator, $value];
        return $this;
    }

    public function whereIn($column, array $values)
    {
        $this->conditions[] = [$column, 'IN', $values];
        return $this;
    }

    public function orderBy($field, $direction = 'ASC')
    {
        $this->orderBy = [$field, $direction];
        return $this;
    }

    public function offset($offset)
    {
        $this->offset = $offset;
        return $this;
    }

    public function limit($limit)
    {
        $this->limit = $limit;
        return $this;
    }

    public function create($data)
    {
        $this->data = $data;
        $this->queryType = 'insert';
        return $this;
    }

    public function update($data)
    {
        $this->data = $data;
        $this->queryType = 'update';
        return $this;
    }

    public function delete()
    {
        $this->queryType = 'delete';
        return $this;
    }

    public function join($table, $first, $operator, $second, $type = 'INNER')
    {
        $this->joins[] = [$type, $table, $first, $operator, $second];
        return $this;
    }

    public function leftJoin($table, $first, $operator, $second)
    {
        return $this->join($table, $first, $operator, $second, 'LEFT');
    }

    public function rightJoin($table, $first, $operator, $second)
    {
        return $this->join($table, $first, $operator, $second, 'RIGHT');
    }

     public function paginate($perPage, $currentPage)
    {
        $this->limit = $perPage;
        $this->offset = ($currentPage - 1) * $perPage;

        $query = $this->buildSelectQuery();
        $result =  mysqli_query($this->conn, $query);

        if (!$result) {
            die('Query Error: ' . mysqli_error($this->conn));
        }

        $this->countData = mysqli_num_rows($result);

        if ($this->countData == 0) {
            return null;
        }

        return new QueryResultPaginate($this->get($result), $this->countData, $perPage, $currentPage);
    }

    public function first()
    {
        $this->limit = 1;
        $query = $this->buildSelectQuery(); 
        $result =  mysqli_query($this->conn, $query);

        if (!$result) {
            die('Query Error: ' . mysqli_error($this->conn));
        }

        if (mysqli_num_rows($result) == 0) {
            return null;
        }

        return new QueryResult(mysqli_fetch_assoc($result), 1);
    }

    public function build()
    {
        switch ($this->queryType) {
            case 'select':
                $query = $this->buildSelectQuery();
                $result =  mysqli_query($this->conn, $query);
                $this->countData = mysqli_num_rows($result);

                return (new QueryResult($this->get($result), $this->countData))->get();
            case 'insert':
                return $this->buildInsertQuery();
            case 'update':
                return $this->buildUpdateQuery();
            case 'delete':
                return $this->buildDeleteQuery();
            default:
                throw new Exception("Invalid query type");
        }
        $this->conn->close();
    }

    protected function buildSelectQuery()
    {
        $query = "SELECT " . implode(', ', $this->fields) . " FROM $this->table";

        foreach ($this->joins as $join) {
            list($type, $table, $first, $operator, $second) = $join;
            $query .= " $type JOIN $table ON $first $operator $second";
        }

        if (!empty($this->conditions)) {
            $query .= " WHERE ";
            foreach ($this->conditions as $condition) {
                if ($condition[1] === 'IN') {
                    $values = implode(', ', array_map(function ($value) {
                        return "'" . mysqli_real_escape_string($this->conn, $value) . "'";
                    }, $condition[2]));
                    $query .= "$condition[0] IN ($values) AND ";
                } else {
                    $query .= "$condition[0] $condition[1] '" . mysqli_real_escape_string($this->conn, $condition[2]) . "' AND ";
                }
            }
            $query = rtrim($query, " AND ");
        }

        if (!empty($this->orderBy)) {
            $query .= " ORDER BY $this->orderBy[0] $this->orderBy[1]";
        }

        if (!empty($this->limit)) {
            $query .= " LIMIT $this->limit";
        }

        if (!empty($this->offset)) {
            $query .= " OFFSET $this->offset";
        }

        return $query;
    }

    protected function buildInsertQuery()
    {
        $this->addTimeUpdateAndCreate();

        $fields = implode(', ', array_keys($this->data));
        $values = "'" . implode("', '", array_values($this->data)) . "'";
        $query = "INSERT INTO $this->table ($fields) VALUES ($values)";

        $result = $this->conn->query($query);

        if (!$result) {
            die('Query Error: ' . $this->conn->error);
        }

        if ($result) {
            $id = $this->conn->insert_id;
        }
        $this->conn->close();
        return $id;
    }

    protected function buildUpdateQuery()
    {
        $this->addTimeUpdateAndCreate(true, false);

        $set = '';
        foreach ($this->data as $key => $value) {
            $set .= "$key = '$value', ";
        }
        $set = rtrim($set, ", ");
        $query = "UPDATE $this->table SET $set";

        if (!empty($this->conditions)) {
            $query .= " WHERE ";
            foreach ($this->conditions as $condition) {
                if ($condition[1] === 'IN') {
                    $values = implode(', ', array_map(function ($value) {
                        return "'" . mysqli_real_escape_string($this->conn, $value) . "'";
                    }, $condition[2]));
                    $query .= "$condition[0] IN ($values) AND ";
                } else {
                    $query .= "$condition[0] $condition[1] '" . mysqli_real_escape_string($this->conn, $condition[2]) . "' AND ";
                }
            }
            $query = rtrim($query, " AND ");
        }

        $result = $this->conn->query($query);

        if (!$result) {
            die('Query Error: ' . $this->conn->error);
        }
        $this->conn->close();
        return true;
    }

    protected function buildDeleteQuery()
    {
        $query = "DELETE FROM $this->table";

        if (!empty($this->conditions)) {
            $query .= " WHERE ";
            foreach ($this->conditions as $condition) {
                if ($condition[1] === 'IN') {
                    $values = implode(', ', array_map(function ($value) {
                        return "'" . mysqli_real_escape_string($this->conn, $value) . "'";
                    }, $condition[2]));
                    $query .= "$condition[0] IN ($values) AND ";
                } else {
                    $query .= "$condition[0] $condition[1] '" . mysqli_real_escape_string($this->conn, $condition[2]) . "' AND ";
                }
            }
            $query = rtrim($query, " AND ");
        }

        if ($this->conn->query($query)) {
            $this->conn->close();

            return true;
        }
        $this->conn->close();
        return false;
    }

    protected function addTimeUpdateAndCreate($update= true, $create = true){
        if($this->time){
            if($update){
                $this->data['updated_at'] = date('Y-m-d H:i:s');
            }

            if($create){
                $this->data['created_at'] = date('Y-m-d H:i:s');
            }
        }
    }

    protected function get($result)
    {
        if (!$result || mysqli_num_rows($result) == 0) {
            return [];
        }

        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }

        return $data;
    }

}