<?php
/** @var $pagination \app\core\Pagination */
$end = ($pagination->srart >= $pagination->pageSize)?$pagination->countRow:$pagination->srart+$pagination->pageSize-1;
$baseUrl =\app\App::$app->baseUrl;
$path = ($baseUrl == 'site')? '/news/page/': '/'.$baseUrl.'/news/page/';
?>

<div class="summary"><p>Показаны записи <b><?=$pagination->srart?>-<?=$end?></b> из <b><?= $pagination->countRow ?></b>.</p></div>
<nav>
  <ul class="pagination">
      <?php if($pagination->currentPage > 1) { ?>
        <li class="page-item">
          <a class="page-link" href="<?=$path?><?=$pagination->currentPage-1;?>" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
            <span class="sr-only">Previous</span>
          </a>
        </li>
      <?php } ?>

      <?php for($i = 1; $i<=$pagination->countPage; $i++) { ?>
        <li class="page-item <?=($i == $pagination->currentPage) ? "active" : ''?>"> <a class="page-link" href="<?=$path?><?=$i;?>"><?=$i;?></a> </li>
      <?php } ?>

      <?php if($pagination->currentPage < $pagination->countPage) { ?>
        <li class="page-item">
          <a class="page-link" href="<?=$path?><?=$pagination->currentPage+1;?>" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
            <span class="sr-only">Next</span>
          </a>
        </li>
      <?php } ?>
  </ul>
</nav>
