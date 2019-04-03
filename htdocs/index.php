<?php

use Yaf\Application as YafApplication;

define('ROOT_PATH', dirname(__FILE__) . '/../');
define('APP_ENV', ini_get('yaf.environ') ? ini_get('yaf.environ') : "develop");
define('APP_PATH', dirname(__FILE__));
define('APP_CLI', false);

$APP = new YafApplication(APP_PATH . "/../conf/app.ini", APP_ENV);
$APP->bootstrap()->run();

?>
