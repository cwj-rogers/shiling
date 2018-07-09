<?php

// ensure we get report on all possible php errors
error_reporting(-1);

defined('YII_ENABLE_ERROR_HANDLER') or define('YII_ENABLE_ERROR_HANDLER', false);
defined('YII_DEBUG') or define('YII_DEBUG', true);
$_SERVER['SCRIPT_NAME'] = '/' . __DIR__;
$_SERVER['SCRIPT_FILENAME'] = __FILE__;

require_once(__DIR__ . '/../../vendor/autoload.php');
require_once(__DIR__ . '/../../vendor/yiisoft/yii2/Yii.php');

Yii::setAlias('@yiiunit/faker', __DIR__);
Yii::setAlias('@yii/faker', dirname(__DIR__) . '/src');

//require_once(__DIR__ . '/compatibility.php');