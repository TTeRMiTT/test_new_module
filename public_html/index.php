<?php
define('DEV', true);
define('ROOT', dirname(dirname(__FILE__)).'/app');
define('WEB_ROOT', dirname(__FILE__));
require_once('../vendor/autoload.php');

(new \app\App())->run('site');

/*
 Вопрос 1
 Mодуль новости.

 Поля

                 * Дата

                 * Заголовок

                 * картинка

                 * Анонс

                 * Тест

 1. админка.

 1.1 добавление (с возможностью прикрепить картинку)

 1.2 вывод списка (с разбивкой по страницам)

 1.3 удаление (не забываем про картинки)

 2. пользовательская часть

 2.1 просмотр списка новостей с разбивкой по страницам, не забываем выводить при наличии картинки её уменьшенную превьюшку.

 2.2 просмотр одной новости
*/