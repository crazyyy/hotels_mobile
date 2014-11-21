<?php

// change the following paths if necessary
$yii=dirname(__FILE__).'/../framework/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',false);

defined('APPLICATION_ENV') or define('APPLICATION_ENV', 'production');

require_once($yii);
Yii::createWebApplication($config)->run();
