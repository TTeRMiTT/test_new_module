<?php
/* @var $this \app\core\View
 * @var $model      array(\app\modules\news\models\News)
 * @var $pagination \app\core\Pagination
 */
$this->title   = 'Admin | Новости';
$viewAttribute = [
  'id',
  'title',
  'preview',
  'image',
  'data',
];
extract($data, EXTR_OVERWRITE);
$labels = $model[0]->attributeLabels();
?>
<div class="news-list">
  <div class="panel-header">
    <h1>Новости
      <small>Список новостей</small>
    </h1>
    <div class="text-right">
      <a class="btn btn-primary btn-sm" href="/admin/news/create" title="Создать">
        <i class="fas fa-plus"></i>
      </a>
    </div>
  </div>
  <div class="panel-body">
    <div id="news-grid" class="table-responsive">
        <?php if (isset($model)) {
            $i = 1;
            ?>
          <table class="table table-striped table-bordered">
            <thead>
            <tr>
              <th style="width: 20px">№</th>
                <?php foreach ($viewAttribute as $label) { ?>
                  <th><?= $labels[$label] ?></th>
                <?php } ?>
              <th style="width:95px;">Действия</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($model as $item) {

                $atr = (object)$item->attributes;
                ?>
              <tr data-key="<?= $atr->id ?>">
                <td><?= $i ?></td>
                  <?php foreach ($viewAttribute as $label) { ?>
                    <td><?= ($label == 'image' && isset($atr->$label)) ? "<img src='/images/news/small/" . $atr->$label . "' style='width:50%'>" : $atr->$label ?></td>
                  <?php } ?>
                <td><a href="/admin/news/view?id=<?= $atr->id ?>" title="Просмотр" aria-label="Просмотр"
                       data-pjax="0"><span
                            class="far fa-eye"></span></a> <a href="/admin/news/update?id=<?= $atr->id ?>"
                                                              title="Редактировать"
                                                              aria-label="Редактировать"
                                                              data-pjax="0"><span
                            class="fas fa-pencil-alt"></span></a> <a href="/admin/news/delete?id=<?= $atr->id ?>"
                                                                     title="Удалить" aria-label="Удалить"
                                                                     data-pjax="0"
                                                                     data-confirm="Вы уверены, что хотите удалить этот элемент?"
                                                                     data-method="post"><span
                            class="far fa-trash-alt"></span></a></td>
              </tr>
                <?php
                $i++;
            } ?>
            </tbody>
          </table>
        <?php } else { ?>
          <p> В списке нет новосте. Создайте новость.</p>
        <?php }
        ?>
        <?= $this->renderWidget('pagination', ['pagination' => $pagination]) ?>
    </div>
  </div>

</div>