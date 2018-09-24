<?php

namespace app\core;


use app\App;

class Pagination
{
    public  $pageSize = 10;
    public  $currentPage;
    public  $countRow;
    public  $countPage;
    private $index    = 'page';
    public $srart;
    /** @var Query */
    private $_query;

    public function __construct($config = [])
    {
        $this->_query = $config['query'];
        if (isset($config['pagination'])) {
            if (is_array($config['pagination'])) {
                foreach ($config['pagination'] as $key => $value) {
                    $this->$key = $value;
                }
            }
        }
        $this->countRow    = $this->_query->count();
        $this->countPage   = $this->getCountPage();
        if(isset(App::$app->request->get()->{$this->index})) {
            $this->currentPage = App::$app->request->get()->{$this->index};
        } else {
            $this->currentPage = 1;
        }
        if ($this->currentPage > $this->countPage) {
            $this->currentPage = $this->countPage;
        }
        $this->srart = ($this->currentPage-1)*$this->pageSize+1;
    }


    private function getCountPage()
    {
        return ceil($this->countRow / $this->pageSize);
    }

    public function render()
    {

        return ['model' => $this->getRowModel(), 'pagination' => $this];
    }

    public function getRowModel()
    {
        $query = $this->_query;

        return $query->orderBy('id', 'ASC')->limit([$this->srart -1, $this->pageSize])->all();
    }

//    public function generatePagination()
//    {
//
//    }
//
//    public function next()
//    {
//
//    }
//
//    public function prev()
//    {
//        if($this->countPage == 1) {
//            return
//        }
//    }


}