<?php

namespace app\modules\news\controllers;


use app\App;
use app\core\Controller;
use app\core\Pagination;
use app\modules\news\models\News;

class SiteController extends Controller
{
    public function actionIndex()
    {
        if(isset(App::$app->request->get()->alias)){
            $news = News::find()->where(['alias' => "'".App::$app->request->get()->alias."'"])->one();
            if(isset($news)) {
                return $this->actionView($news);
            }
        }
        $query = News::find();
        $data  = new Pagination([
          'query'      => $query,
          'pagination' => [
            'pageSize' => 2
          ]
        ]);

        return $this->render('index', [
          'data' => $data->render(),
        ]);
    }

    public function actionView($model)
    {
        return $this->render('view',['model'=> $model]);
    }


}