<?php
extract($data, EXTR_OVERWRITE);
/* @var $this \app\core\View
 * @var $model      array(\app\modules\news\models\News)
 * @var $pagination \app\core\Pagination
 */

$this->title = 'Новости';
//var_dump($model);
?>

  <h1><?= $this->title ?></h1>

<?php foreach ($model as $item) { ?>
    <?php /** @var $item \app\modules\news\models\News */ ?>
  <div class="card">
    <div class="card-header">
      <h3><a href="/news/<?= $item->alias ?>"><?= $item->title ?></a></h3>

    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-md-5  article-image-preview">
            <?php if ($item->image != '') { ?>
              <img src="/images/news/preview/<?= $item->image ?>"
                   alt="Заливает в уши идеологический яд: «Гоблин» Пучков сравнил Улицкую с насекомым за слова о России">
            <?php } ?>
        </div>
        <div class="col-md-5 annonce">
            <?= $item->preview ?>
        </div>
      </div>
    </div>
    <div class="card-footer text-muted">
      <div class="row">
        <div class="col-md-6">
          <a class="btn btn-primary btn-xs" href="/news/<?= $item->alias ?>">Читать далее...</a></div>
        <div class="col-md-6">
          <time class="badge pull-right" datetime="2018-06-27T21:54:53+02:00"
                pubdate="pubdate"><?= $item->data ?></time>
        </div>
      </div>
    </div>
  </div>
<?php } ?>
<?= $this->renderWidget('pagination', ['pagination' => $pagination]) ?>

