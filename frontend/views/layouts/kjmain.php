<?php
use yii\helpers\Url;

//\frontend\assets\IeAsset::register($this);
//\frontend\assets\CoreAsset::register($this);
//\frontend\assets\ComponentsAsset::register($this);
//\frontend\assets\AppAsset::register($this);
//$this->beginPage();
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>荟家装砍价活动</title>

    <!-- Bootstrap -->
    <link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.0.2/css/swiper.min.css">
    <link href="https://cdn.bootcss.com/animate.css/3.5.2/animate.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://res.wx.qq.com/open/libs/weui/0.4.3/weui.min.css">
    <link rel="stylesheet" href="<?=Yii::getAlias('@web')?>/static/style.css">
</head>
<body>


<div class="container-fluid">
    <?=$content?>
</div>
<div class="foot">
    <div class="item "> <a class="<?= Yii::$app->request->getUrl()=="/index/index"?'active':'';?>" name="" id="" href="<?= Url::toRoute('index')?>"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> 砍价商品</a></div>
    <div class="item"> <a class="<?= Yii::$app->request->getUrl()=="/index/user"?'active':'';?>" id="" href="<?= Url::toRoute('user')?>"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> 我的砍价</a></div>
</div>

<!-- jQuery (Bootstrap 的所有 JavaScript 插件都依赖 jQuery，所以必须放在前边) -->
<script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
<!-- 加载 Bootstrap 的所有 JavaScript 插件。你也可以根据需要只加载单个插件。 -->
<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.0.2/js/swiper.min.js"></script>
<!--<sctipt src="https://cdn.bootcss.com/vue/2.0.0/vue.min.js"></sctipt>-->
<script src="<?=Yii::getAlias('@web')?>/static/kjmain.js"></script>

</body>
</html>

