<?php
/**
 * Yii bootstrap file.
 * Used for enhanced IDE code autocompletion.
 */

require(__DIR__ . '/../../vendor/yiisoft/yii2/BaseYii.php');

class Yii extends \yii\BaseYii
{
    /**
     * @var BaseApplication|WebApplication the application instance
     */
    public static $app;
}

spl_autoload_register(['Yii', 'autoload'], true, true);
Yii::$classMap = include(__DIR__ . '/../../vendor/yiisoft/yii2/classes.php');
Yii::$container = new yii\di\Container;

/**
 * Class BaseApplication
 * Used for properties that are identical for both WebApplication and ConsoleApplication
 *
 * @property \maxwen\easywechat\Wechat $wechat
 */
abstract class BaseApplication extends yii\base\Application
{
}

/**
 * Class WebApplication
 * Include only Web application related components here
 */
class WebApplication extends yii\web\Application
{
}