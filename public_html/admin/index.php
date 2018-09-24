<?php
define('DEV', true);
define('ROOT', dirname(dirname(dirname(__FILE__))).'/app');
define('WEB_ROOT', dirname(dirname(__FILE__)));

require_once('../../vendor/autoload.php');

(new \app\App())->run('admin');