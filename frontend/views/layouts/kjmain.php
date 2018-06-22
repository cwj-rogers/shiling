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
    <title>荟家装九块九严选</title>

    <!-- Bootstrap -->
    <link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.0.2/css/swiper.min.css">
    <link href="https://cdn.bootcss.com/animate.css/3.5.2/animate.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://res.wx.qq.com/open/libs/weui/0.4.3/weui.min.css">
    <link rel="stylesheet" href="<?=Yii::getAlias('@web')?>/static/style.css">
    <link rel="stylesheet" href="https://at.alicdn.com/t/font_709566_7k8n006po2o.css">
    <!-- jQuery (Bootstrap 的所有 JavaScript 插件都依赖 jQuery，所以必须放在前边) -->
    <script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
    <!--  微信分享配置  -->
    <script src="http://res.wx.qq.com/open/js/jweixin-1.2.0.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript" charset="utf-8">
        wx.config(<?= Yii::$app->wechat->js->config(array('onMenuShareTimeline', 'onMenuShareAppMessage', 'openLocation', 'getLocation'), false, false) ?>);
        var locationUrl = <?= json_encode(Url::toRoute('user-local'));?>
    </script>
</head>
<body>


<div class="container-fluid">
    <?=$content?>
</div>
<div class="foot">
    <div class="item "> <a class="<?= Yii::$app->request->getUrl()=="/index/index"||Yii::$app->request->getUrl()=="/"?'active':'';?>" name="" id="" href="<?= Url::toRoute('index')?>"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> 砍价商品</a></div>
    <div class="item"> <a class="<?= strstr(Yii::$app->request->getUrl(),'?',true)=="/index/user"?'active':'';?>" id="" href="<?= Url::toRoute(['user','ago_status'=>1])?>"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> 我的砍价</a></div>
</div>

<!-- 加载 Bootstrap 的所有 JavaScript 插件。你也可以根据需要只加载单个插件。 -->
<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.0.2/js/swiper.min.js"></script>
<!--<sctipt src="https://cdn.bootcss.com/vue/2.0.0/vue.min.js"></sctipt>-->
<script src="<?=Yii::getAlias('@web')?>/static/kjmain.js"></script>
<script type="text/javascript" charset="utf-8">

    // 除详情页外共用的分享页
    var requestUrl = <?= json_encode(strstr(basename(Yii::$app->request->getUrl()), '?',true));?>;
    var localUrl = location.href;
    if(requestUrl != "detail"){
        wx.ready (function () {
            var $wx_share = [
                'http://hjzhome.image.alimmdn.com/%E5%BE%AE%E4%BF%A1/9.9small.png',
                localUrl,
                '荟家装9.9元严选',
                '#荟家装九块九严选# 严选高端产品低价疯抢,最低9.9元打包带回家'
            ];          // 微信分享的数据
            var shareData = {
                "imgUrl" : $wx_share[0],    // 分享显示的缩略图地址
                "link" : $wx_share[1],    // 分享地址
                "title" : $wx_share[2],   // 分享标题
                "desc" : $wx_share[3],   // 分享描述
                success : function () {
                    // 个人分享成功, 获得再次砍价资格
                    toast("分享成功");
                }
            };
            wx.onMenuShareTimeline (shareData);
            wx.onMenuShareAppMessage (shareData);
            wx.getLocation({
                type: 'wgs84', // 默认为wgs84的gps坐标，如果要返回直接给openLocation用的火星坐标，可传入'gcj02'
                success: function (res) {
                    var latitude = res.latitude; // 纬度，浮点数，范围为90 ~ -90
                    var longitude = res.longitude; // 经度，浮点数，范围为180 ~ -180。
                    sessionStorage.latitude = latitude;
                    sessionStorage.longitude = longitude;
                    getLocation(latitude+','+longitude);
                }
            });
        });
    }
</script>
</body>
</html>

