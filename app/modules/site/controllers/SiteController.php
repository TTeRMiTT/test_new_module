<?php

namespace app\modules\site\controllers;


use app\core\Controller;

class SiteController extends Controller
{
    public $layout = 'site';
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionAbout()
    {
        return $this->render('about');
    }

}