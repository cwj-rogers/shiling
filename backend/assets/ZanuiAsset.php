<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Class ZanuiAsset
 * @package backend\assets
 */
class ZanuiAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $depends = [

    ];
    /* 全局CSS文件 */
    public $css = [
        "static/css/bootstrap.min14ed.css?v=3.3.6",
        "static/css/font-awesome.min93e3.css?v=4.4.0",
        "static/css/animate.min.css",
        "static/css/style.min862f.css?v=4.1.0",
    ];
    /* 全局JS文件 */
    public $js = [
        //"static/js/jquery.min.js?v=2.1.4", 方便页面写jq,提前加载
        "static/js/bootstrap.min.js?v=3.3.6",
        //"static/js/content.min.js?v=1.0.0",
        "static/js/plugins/flot/jquery.flot.js",
        "static/js/plugins/flot/jquery.flot.tooltip.min.js",
        "static/js/plugins/flot/jquery.flot.resize.js",
        "static/js/plugins/chartJs/Chart.min.js",
        "static/js/plugins/peity/jquery.peity.min.js",
        "static/js/demo/peity-demo.min.js",
        "https://cdn.bootcss.com/vue/2.5.16/vue.min.js"
    ];

    /**
     * ------------------------------------------
     * 定义按需加载JS方法，注意加载顺序在最后
     * @param $view \yii\web\View
     * @param $jsfile string
     * ------------------------------------------
     */
    public static function addScript($view, $jsfile, $pos) {
        $view->registerJsFile($jsfile,['position'=>$pos]);
    }

    /**
     * ------------------------------------------
     * 定义按需加载css方法，注意加载顺序在最后
     * @param $view \yii\web\View
     * @param $cssfile string
     * ------------------------------------------
     */
    public static function addCss($view, $cssfile) {
        $view->registerCssFile($cssfile, [AppAsset::className(), 'depends' => 'backend\assets\AppAsset']);
    }
}
