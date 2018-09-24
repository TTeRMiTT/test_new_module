<?php

namespace app\core;


class Object
{
    public static function className()
    {
        return get_called_class();
    }

    public function __construct($config = [])
    {
        $this->init($config);
    }

    public function init($config)
    {
        foreach ($config as $name => $value) {
            $this->$name = $value;
        }

        return $this;
    }

    public function __get($name)
    {
        $getter = 'get' . $name;
        if (method_exists($this, $getter)) {
            return $this->$getter();
        }
    }

    public function __set($name, $value)
    {
        $setter = 'set' . $name;
        if (method_exists($this, $setter)) {
            $this->$setter($value);
        }
    }

    public function __isset($name)
    {
        $getter = 'get' . $name;
        if (method_exists($this, $getter)) {
            return $this->$getter() !== null;
        }

        return false;
    }

    public function __unset($name)
    {
        $setter = 'set' . $name;
        if (method_exists($this, $setter)) {
            $this->$setter(null);
        }
    }

}