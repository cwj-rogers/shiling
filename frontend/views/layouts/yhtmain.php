<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/26 0026
 * Time: 下午 2:04
 */
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>云合同</title>
    <link href="https://cdn.bootcss.com/weui/1.1.2/style/weui.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.bootcss.com/jquery-weui/1.2.0/css/jquery-weui.min.css">
    <link rel="stylesheet" href="<?=Yii::getAlias('@web')?>/static/yht.css">
    <!--  阿里ICON  -->
    <script src="//at.alicdn.com/t/font_764675_t732n1zggk.js"></script>
    <script src="https://cdn.bootcss.com/jquery/1.11.0/jquery.min.js"></script>

    <!--  微信分享配置  -->
    <script src="http://res.wx.qq.com/open/js/jweixin-1.2.0.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript" charset="utf-8">
        $(function () {
            wx.config(<?= Yii::$app->wechat->js->config(array('onMenuShareAppMessage'), false, false) ?>);
        });
    </script>
</head>
<body>
    <div id="container" style="position: relative;z-index: 888;margin-bottom: 80px">
        <?=$content?>
    </div>
    <!-- 通用页脚 -->
    <div class="weui-footer weui-footer_fixed-bottom" style="z-index: 1">
        <p class="weui-footer__links">
            <a href="//www.hjzhome.com" class="weui-footer__link" style="line-height: 15px">
                <img src="http://hjzhome.image.alimmdn.com/首页图片/map-logo.png" style="width: 65px">
            </a>
        </p>
        <p class="weui-footer__text">Copyright © 2018-2020 荟家装·保留所有权利</p>
    </div>
</body>
</html>

<script src="https://cdn.bootcss.com/jquery-weui/1.2.0/js/jquery-weui.min.js"></script>
<!-- 如果使用了某些拓展插件还需要额外的JS -->
<!--<script src="https://cdn.bootcss.com/jquery-weui/1.2.0/js/swiper.min.js"></script>-->
<!--<script src="https://cdn.bootcss.com/jquery-weui/1.2.0/js/city-picker.min.js"></script>-->




