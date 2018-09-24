<?php

namespace app\core;


use app\App;

class Db
{
    /**
     * @var \mysqli
     */
    protected $db;
    protected $query;
    /**
     * @var \mysqli_result
     */
    private $_result;

    public function __construct()
    {
        $params   = App::$app->db;
        $this->db = new $params['type']($params['host'], $params['user'], $params['pass'], $params['dbname']);
        $this->db->set_charset("utf8");

        return $this->db;

    }

    public function count()
    {
        $result = $this->query();

        return $result->num_rows;
    }

    private function query()
    {
        return $this->db->query($this->query);
    }

    public function exec($fetch = 'fields')
    {
        if (!method_exists($this->_result, $fetch)) {
            $fetch = 'fetch_' . $fetch;
        }

        return $this->_result->$fetch();

    }

    public function getFields()
    {
       return $this->query()->fetch_fields();
    }


    public function one()
    {
        return $this->query()->fetch_assoc();
    }

    public function all()
    {
        $result = [];
        $query  = $this->query();
        while ($row = $query->fetch_assoc()) {
            $result[] = $row;
        }
        $query->free();

        return $result;
    }

    public function __destruct()
    {
        $this->db->close();
    }

    public function run()
    {
        return $this->query();
    }
}