<?php
/* @var $this \app\core\View */
/* @var $model \app\modules\news\models\News */
?>
<h1>Новости
  <small><?= $this->title?></small>
</h1>
<form id="news" method="post" action="/admin/news/<?= ($model->isNewRecord)? 'create': 'update?id='.$model->attributes['id']?>" enctype="multipart/form-data">
  <div class="form-group">
    <label for="news-title">Заголовок</label>
    <input type="text" name="title" class="form-control" id="news-title" placeholder="Заголовок" value="<?= (isset($model->attributes['title']))?$model->attributes['title']: ''?>">
  </div>
  <div class="form-group">
    <label for="news-file">Изображение</label>
    <div class="row">
        <?php if(isset($model->attributes['image']) && ($model->attributes['image'] != null)) { ?>
          <div class="col-md-2">
            <img src="<?= $model->imageUploadPath.'small/'. $model->attributes['image'] ?>" alt="<?= $model->attributes['title'] ?>" >
          </div>
        <?php } ?>
      <div class="col-md-9">
        <input type="file" name="image" class="form-control-file col-md-9" id="news-file">
      </div>
    </div>
  </div>
  <div class="form-group">
    <label for="news-preview">Анонс</label>
    <textarea class="form-control editor-swj" id="news-preview" name="preview"><?= (isset($model->attributes['preview']))?$model->attributes['preview']: ''?></textarea>
  </div>
  <div class="form-group">
    <label for="news-content">Контент</label>
    <textarea class="form-control editor-swj" id="news-content" name="content"><?= (isset($model->attributes['content']))?$model->attributes['content']: ''?></textarea>
  </div>

  <input type="submit" name="submit" class="btn btn-primary" value="<?= ($model->isNewRecord)? 'Создать': 'Сохранить'?>">
  <a class="btn btn-outline-secondary" href="/admin/news">Назад</a>
</form>
