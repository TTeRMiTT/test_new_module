<?php

namespace app\core;


class Request
{
    public $uri;
    public $query;
    public $post = null;
    public $get  = null;


    public function getUri()
    {
        if ($this->uri == null) {
            return $this->parseRequestUri()[0];
        } else {
            return $this->uri;
        }
    }

    protected function parseRequestUri()
    {
        if (!empty($_SERVER['REQUEST_URI'])) {
            $uri = trim($_SERVER['REQUEST_URI'], '/');
            $uri = explode('?', $uri);
            if (count($uri) > 1) {
                $this->uri   = $uri[0];
                $this->query = $uri[1];
            } else {
                $this->uri   = $uri[0];
                $uri[1]      = '';
                $this->query = '';
            }

            return $uri;

        } else {
            return null;
        }
    }

    public function post()
    {
        if (isset($_POST)) {
            $post = [];
            foreach ($_POST as $key_post => $value_post) {
                if ($key_post != 'submit') {
                    $post[$key_post] = $value_post;
                }
            }
            $this->post = $post;

            return $this->post;
        } else {
            $this->post = null;

            return null;
        }
    }

    public function get()
    {
        if ($this->get == null) {
            $this->addGetParam();
        }
        if ($this->get == null) {
            return null;
        }

        return (object)$this->get;
    }

    public function addGetParam($params = null)
    {

        $get = [];
        if ($this->getQuery() != '') {
            $query = explode('&', $this->getQuery());
            foreach ($query as $item) {
                $item          = explode('=', $item);
                $get[$item[0]] = $item[1];
            }
        }
        if(count($params) == 1){
            $get['alias'] = $params[0];
        }elseif ($params !== null ) {
            $i = 0;
            while ($i < count($params)) {
                $get[$params[$i]] = $params[$i + 1];
                $i                += 2;
            }
        }

        if ($get == []) {
            $this->get = null;
        } else {
            $this->get = $get;
        }

    }



    public function getQuery()
    {
        if ($this->query == null) {
            return $this->parseRequestUri()[1];
        } else {
            return $this->query;
        }
    }

    public function redirect($url)
    {
        header('Location:'. $url);
    }


}