<?php


namespace app\modules\news\controllers;


use app\App;
use app\core\Controller;
use app\core\Pagination;
use app\core\Slug;
use app\core\UploadedFile;
use app\modules\news\models\News;


class AdminController extends Controller
{
    public function actionIndex()
    {
        $query       = News::find();
        $data = new Pagination([
            'query'=> $query,
            'pagination' => [
              'pageSize' => 3
            ]
        ]);

        return $this->render('index', [
          'data'      => $data->render(),
        ]);
    }

    public function actionCreate()
    {
        return $this->actionUpdate(false);
    }

    public function actionUpdate($id = false)
    {
        if ($id == false) {
            $model = new News();
        } else {
            $model = $this->findModel($id);
        }

        if ($model->load(App::$app->request->post())) {
            $file         = UploadedFile::getImage('image');
            $model->alias = Slug::make($model->title);
            $model->data  = (new \DateTime('now', new \DateTimeZone('Europe/Moscow')))->format('Y-m-d H:i:s');
            if (isset($file)) {
                $file->oldName = $model->image;
                $model->image  = $file->uploadImage($model->alias, $model->imageUploadPath)->name;
            }
            $model->save();
            if (!isset($model->id)){
                $model->id = News::find('id')->orderBy('id','DESC')->one()->id;
            }

            return $this->redirect('/admin/news/view?id=' . $model->id);
        } else {
            return $this->render($id === false ? 'create' : 'update', [
              'model' => $model,
            ]);
        }
    }

    protected function findModel($id)
    {
        if (($model = News::findOne($id)) !== null) {
            return $model;
        } else {
//            throw new \Exception('По указанному адресу страница не найдена.');
            return new News();
        }
    }

    public function actionView($id)
    {
        return $this->render('view', [
          'model' => $this->findModel($id),
        ]);
    }

    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        UploadedFile::deleteFile($model->image, $model->imageUploadPath);
        $model->delete();
        return $this->redirect('index');
    }

}