<?php
/** @var $model \app\modules\news\models\News */
?>
<article class="card">
  <div class="panel panel-default">
    <div class="card-header">
      <h1><?= $model->title ?></h1>
    </div>
    <div class="card-body">
      <div class="news-content">
          <?php if($model->image != '') {?>
            <img src="/images/news/<?=$model->image?>" alt="">
          <?php }?>
          <?= $model->content ?>
      </div>
    </div>
    <div class="card-footer">
      <small><?= $model->data ?></small>
    </div>
  </div>
</article>
