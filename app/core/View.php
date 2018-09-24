<?php

namespace app\core;


use app\App;

class View
{
    public $title;
    public function render($views, $params = [])
    {
//        var_dump($views);
        $module = App::$app->module;
        $viewFile = $module->basePath.'/'. $module->id. '/views/'.App::$app->module->baseUrl.'/' . $views;
        ob_start();
        ob_implicit_flush(false);
        extract($params, EXTR_OVERWRITE);
        echo $this->renderFile($viewFile, $params);

        return ob_get_clean();
    }

    public function renderFile($file, $params = [])
    {
        ob_start();
        ob_implicit_flush(false);
        extract($params, EXTR_OVERWRITE);
        require $file . '.php';

        return ob_get_clean();
    }

    public function renderWidget($file, $params = [])
    {
        $file =  ROOT . '/layouts/widgets/' .$file.'/index';
        ob_start();
        ob_implicit_flush(false);
        extract($params, EXTR_OVERWRITE);
        echo $this->renderFile($file, $params);

        return ob_get_clean();

    }

}