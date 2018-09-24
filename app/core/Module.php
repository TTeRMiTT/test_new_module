<?php

namespace app\core;


use app\App;

class Module
{
    public $layout;

    public $namespace;

    public $basePath;
    public $baseUrl;
    public $params;
    protected $_params;

    public $id;

    public $defaultController = 'site';
    public $controller;

    public function __construct($route)
    {
        $this->id = $route->module;
        $this->namespace = 'app\\modules\\'.$this->id;
        $this->controller = $route->controller;
        $this->baseUrl = $route->baseUrl;
        $this->params = $route->params;
    }

    public function init()
    {

        $controller   = $this->namespace . '\\controllers\\'. (($this->controller)? ucfirst($this->controller): ucfirst($this->defaultController)) .'Controller';

        if (class_exists($controller)) {
            $controller  = new $controller();
            if (count($this->params) == 0){
                $action = 'index';
            } else {
                $action = $this->params[0];
            }
            return $controller->action($action, $this->params);
        }

    }

}