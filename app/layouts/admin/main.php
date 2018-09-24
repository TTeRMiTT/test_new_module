<?php

use app\App;

$menu = [
  ['title' => 'Главная', 'url' => '/admin'],
  ['title' => 'Новости', 'url' => '/admin/news'],
];


?>
<!doctype html>
<html lang="<?= App::$app->language ?>">

<head>
  <!-- Required meta tags -->
  <meta charset="<?= App::$app->charset ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

  <link rel="stylesheet" href="/css/site.css">
  <title><?= $this->title ?></title>
</head>
<body>

  <header>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
      <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault"
                aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
          <ul class="navbar-nav mr-auto">
              <?php
              foreach ($menu as $menu_item) {
                  $menu_item = (object)$menu_item;
                  ?>
                <li class="nav-item"><a class="nav-link" href="<?= $menu_item->url ?>"><?= $menu_item->title ?></a></li>
                  <?php
              }
              ?>
          </ul>
        </div>
      </div>
    </nav>
  </header>

  <main role="main">
    <div class="container">
        <?= $content ?>
    </div>
  </main>


  <footer>
    <div class="container">
      &copy; Company 2018
    </div>
  </footer>


<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
  <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=blu57odfdx1d020gip71h2yutd7yizsedhozvt4m742i2lce"></script>
  <script src="/script/main.js"></script>
</body>
</html>
