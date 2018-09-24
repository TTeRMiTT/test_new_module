<?php

namespace app\core;


class Model extends Object
{

    public $attributes;
    private $fields;

    public function __construct(array $config = [])
    {
        $this->fields =Query::getFieldAll(static::tableName());
        parent::__construct($config);
    }


    public static function findOne($id)
    {
        $query = static::find();
        $query->where(['id' => $id]);

        return $query->one();
    }


    public static function find($attribute = [])
    {
        $query = new Query();

        return $query->find(get_called_class(), $attribute);
    }

    public static function _get($result)
    {
        $class  = get_called_class();
        $models = [];
        foreach ($result as $value) {
            $model             = new $class();
            $model->attributes = $value;
            $models[]          = $model;
        }

        return $models;
    }

    public static function findAll()
    {
        return static::find()->all();
    }

    public function save()
    {
        if ($this->isNewRecord()) {
            return $this->insert();
        }

        return $this->update() !== false;
    }

    public function isNewRecord()
    {
        if (!isset($this->attributes['id'])) {
            return true;
        } else {
            return false;
        }
    }

    public function update()
    {
        if (!$this->validate()) {
            return false;
        }

        $query      = new Query();
        $query->update(static::tableName(), $this->attributes);
        $query->where(['id' => $this->attributes['id']]);

        return $query->run();

    }

    public function insert()
    {
        if (!$this->validate()) {
            return false;
        }

        $query      = new Query();
        $query->insert(static::tableName(), $this->attributes);

        return $query->run();

    }

    public function delete()
    {
        $query      = new Query();
        $query->delete(static::tableName(), ['id' => $this->id]);
        return $query->run();
    }

    public function validate()
    {
        return true; //todo заглушка валидации
    }

    public static function tableName()
    {
        return '';
    }

    public function attributeLabels()
    {
        return [];
    }

    public function load($data)
    {
        if (!empty($data)) {
            $fields = array_flip($this->fields);
            foreach ($data as $name => $value) {
                if (isset($fields[$name])) {
                    $this->$name = $value;
                }
            }

            return true;
        }

        return false;
    }

    public function __get($name)
    {
        if (isset($this->attributes[$name])) {
            return $this->attributes[$name];
        } elseif (method_exists($this, $name)) {
            return $this->$name = $this->$name();
        } else {
            parent::__get($name);
        }
    }

    public function __set($name, $value)
    {
        $fields = array_flip($this->fields);
        if (isset($fields[$name])) {
            $this->attributes[$name] = $value;
        } else {
            parent::__set($name, $value);
        }
    }


}