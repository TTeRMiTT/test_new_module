<?php


namespace app\core;


class Query extends Db
{
    private $modelClass;

    public function orderBy($condition, $sort = 'ASC')
    {
        $this->query = $this->query . " ORDER BY `$condition` $sort";

        return $this;
    }

    public function where($condition)
    {
        if (is_string($condition)) {
            $this->query = $this->query . " WHERE " . $this->db->real_escape_string($condition);
        } elseif (is_array($condition)) {
            if (count($condition) == 1) {
                foreach ($condition as $key => $value) {
                    $this->query = $this->query . " WHERE `$key` = $value";
                }
            } elseif (count($condition) == 3) {
                $this->query = $this->query . " WHERE `$condition[0]` $condition[1] $condition[2]";
            }
        }

        return $this;
    }

    public function andWhere($condition, $aspect = 'AND')
    {
        if (is_string($condition)) {
            $this->query = $this->query . " $aspect " . $this->db->real_escape_string($condition);
        } elseif (is_array($condition)) {
            if (count($condition) == 1) {
                foreach ($condition as $key => $value) {
                    $this->query = $this->query . " $aspect `$key` = $value";
                }
            } elseif (count($condition) == 3) {
                $this->query = $this->query . " $aspect `$condition[0]` $condition[1] $condition[2]";
            }
        }

        return $this;
    }

    public function getClassModel()
    {
        return $this->modelClass;
    }

    public function limit($limit)
    {
        if (is_string($limit)) {
            $this->query = $this->query . ' LIMIT ' . $this->db->real_escape_string($limit);
        } elseif (is_array($limit)) {
            if (count($limit) == 1) {
                $this->query = $this->query . ' LIMIT ' . $limit[0];
            } elseif (count($limit) == 2) {
                $this->query = $this->query . " LIMIT $limit[0],$limit[1]";
            }
        }

        return $this;
    }

    public function insert($table, $attribute)
    {
        $this->query = "INSERT INTO `$table` SET ";
        if (is_array($attribute)) {
            $attributes = [];
            foreach ($attribute as $key => $value) {
                $attributes[] = "`" . $this->db->real_escape_string($key) . "`" . '=' . "'" . $value . "'";
            }
            $attribute = implode(',', $attributes);
        } elseif (is_string($attribute)) {
            $attribute = $this->db->real_escape_string($attribute);
        }

        $this->query = $this->query . $attribute;

        return $this;
    }

    public function delete($table, $condition = null)
    {
        $this->query = "DELETE FROM `$table` ";
        if(!empty($condition)){
            $this->where($condition);
        }

        return $this;
    }

    public function update($table, $attribute = [])
    {
        $this->query = "UPDATE `$table` SET ";
        if (is_array($attribute)) {
            $attributes = [];
            foreach ($attribute as $key => $value) {
                $attributes[] = "`" . $this->db->real_escape_string($key) . "`" . '=' . "'" . $value . "'";
            }
            $attribute = implode(',', $attributes);
        } elseif (is_string($attribute)) {
            $attribute = $this->db->real_escape_string($attribute);
        }

        $this->query = $this->query . $attribute;

        return $this;
    }

    public function find($class, $attribute = [])
    {
        $this->modelClass = $class;

        return $this->select($class::tableName(), $attribute);

    }

    public function select($table, $attribute = [])
    {
        if ($attribute === []) {
            $attribute = '*';
        } else {
            if (is_array($attribute)) {
                foreach ($attribute as $key => $value) {
                    $attribute[$key] = "`" . $this->db->real_escape_string($value) . "`";
                }
                $attribute = implode(',', $attribute);
            } elseif (is_string($attribute)) {
                $attribute = $this->db->real_escape_string($attribute);
            }
        }
        $this->query = "SELECT $attribute FROM `$table`";

        return $this;
    }

    public function one()
    {
        $result = parent::one();

        return ($this->modelClass)::_get([$result])[0];
    }

    public function all()
    {
        $result = parent::all();
//        if (empty($result)) {
//            return new $this->modelClass();
//        }
        return ($this->modelClass)::_get($result);
    }

    public static function getFieldAll($table)
    {
        $query = new Query();
        $result = [];
        foreach ($query->select($table)->getFields() as $field){
            $result[] = $field->name;
        }
        return $result;
    }


}