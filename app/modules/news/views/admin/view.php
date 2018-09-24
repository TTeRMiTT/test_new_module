<?php
/* @var $this \app\core\View */
/* @var $model \app\modules\news\models\News */

$this->title = 'Просмотр новости';
?>
<div class="news-view">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h1><?= $this->title ?></h1>
      <div class="text-right">
        <a class="btn btn-outline-secondary btn-sm" href="/admin/news" title="К списку">
          <i class="fa fa-list"></i>
        </a>
        <a class="btn btn-success btn-sm" href="/admin/news/update?id=<?=$model->id?>" title="Обновить">
          <i class="fa fa-pencil-alt"></i>
        </a>
        <a class="btn btn-primary btn-sm" href="/admin/news/create" title="Создать">
          <i class="fa fa-plus"></i>
        </a>
        <a class="btn btn-danger btn-sm" href="/admin/news/delete?id=<?=$model->id?>" title="Удалить" data-confirm="Вы действительно хотите удалить этот элемент?" data-method="post">
          <i class="fa fa-trash"></i>
        </a>
      </div>
    </div>
    <div class="panel-body">
      <table id="w0" class="table table-striped table-bordered detail-view">
        <tbody>
        <?php foreach ($model->attributes as $key => $value) {
            if ($key == 'image' && isset($value)) {
                $value = "<img src='" . $model->imageUploadPath . "small/" . $value . "' >";
            }
            ?>
          <tr>
            <th style="width: 10%"><?= $model->attributeLabels()[$key] ?></th>
            <td><?= $value ?></td>
          </tr>
        <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>