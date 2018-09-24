<?php

namespace app\modules\site\controllers;


use app\core\Controller;

class ErrorController extends Controller
{
    public $layout = 'error';
    public function actionIndex()
    {
        return $this->render('index');
    }
}