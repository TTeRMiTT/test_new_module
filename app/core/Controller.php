<?php

namespace app\core;

use app\App;

class Controller extends Object
{
    /**
     * @var \app\core\View
     */
    public $_view;

    public $route;

    public $layout;

    public function __construct($config = [])
    {
        $this->getLayout();
        parent::__construct($config);
    }

    public function render($view, $params = [])
    {
        $content = $this->getView()->render($view, $params);

        return $this->renderContent($content);
    }

    public function renderContent($content)
    {
        $layoutFile = ROOT . '/layouts/' . $this->layout . '/main';
        if ($layoutFile !== false) {
            return $this->getView()->renderFile($layoutFile, ['content' => $content]);
        }

        return $content;
    }

    public function redirect($url)
    {
        return App::$app->request->redirect($url);
    }

    public function getView()
    {
        if ($this->_view === null) {
            $this->_view = App::$app->getView();
        }

        return $this->_view;
    }

    public function setView($view)
    {
        $this->_view = $view;
    }

    public function renderUrl()
    {

    }

    public function getLayout()
    {
        if ($this->layout == null) {
            $this->layout = App::$app->baseUrl;
        }

        return $this->layout;

    }

    public function action($action = 'index', $params = [])
    {
        $action = 'action'.ucfirst($action);
        if (!method_exists($this, $action)) {
            $action = 'actionIndex';
        }
        if(count($params) > 0){
            App::$app->request->addGetParam($params);
        }

        if (isset(App::$app->request->get()->id)) {
            return $this->$action(App::$app->request->get()->id);
        }else {
            return $this->$action();
        }
    }


}