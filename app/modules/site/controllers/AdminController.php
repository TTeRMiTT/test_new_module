<?php

namespace app\modules\site\controllers;


use app\core\Controller;

class AdminController extends Controller
{
    public $layout = 'admin';
    public function actionIndex()
    {
        return $this->render('index');
    }
}