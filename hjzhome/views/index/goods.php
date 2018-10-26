<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/5 0005
 * Time: 下午 5:53
 */
use yii\helpers\Url;
?>
<!DOCTYPE HTML>
<html class="isMobile  ">
<head>
    <!--  头部文件  -->
    <?php $this->beginContent('@app/views/layouts/hjz/side-head.php') ?><?php $this->endContent() ?>
    <meta name="generator" content="MetInfo 5.3.19"  data-variable="https://show.metinfo.cn/muban/M1156010/328/,cn,25,,7,M1156010" />
</head>
<body class="class-25">
<style>
    .tab-content img{width: 100%;!important;height: auto;!important;}
    .iframe,.product-text{padding: 20px}
</style>
<!--[if lte IE 8]>
<div class="text-center padding-top-50 padding-bottom-50 bg-blue-grey-100">
    <p class="browserupgrade font-size-18">你正在使用一个
        <strong>过时</strong>的浏览器。请
        <a href="http://browsehappy.com/" target="_blank">升级您的浏览器</a>，以提高您的体验。
    </p>
</div>
<![endif]-->
<div class="side-open">
    <hr>
    <hr>
    <hr>
    <hr>
</div>
<!--  侧边栏  -->
<?php $this->beginContent('@app/views/layouts/hjz/side-box.php') ?><?php $this->endContent() ?>
<!--  导航栏  -->
<div class="side-head nav-open1">
    <!--  品牌LOGO  -->
    <?php $this->beginContent('@app/views/layouts/hjz/side-logo.php') ?><?php $this->endContent() ?>
    <div class="sign-box">
        <ul class="sign-ul swiper-nav">
            <li class="sign-li active">
                <a href="<?= Url::toRoute(['about'])?>"  title="全部">
                    <b>全部</b>
                </a>
            </li>
        </ul>
    </div>
</div>
<!--  内容  -->
<div class="side-content ">
    <div class="banner-sub auto not-has" data-height="420|350|200"></div>
    <div class="side-html">
        <div class="side-body swiper-lazy" data-background="http://hjzhome.image.alimmdn.com/hjzWebsite/背景图/9.jpg">
            <div class="page met-showproduct pagetype1 animsition">
                <!--       头部效果图开始         -->
                <?php if (!empty($src)):?>
                <div class="met-showproduct-head">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-9">
                                <div class="row iframe">
                                    <iframe id="effect-pic" src="" data-src="<?= $src?>" width="100%" height="400rem" scrolling="no" frameborder="0"></iframe>
                                </div>
                            </div>
                            <div class="col-md-3 product-intro">
                                <div class="row">
                                    <div class="product-text">
                                        <h3><?= $goods['title']?></h3>
                                        <span class="t">
                                            <i class="fa fa-clock-o"></i> <?= date("Y-m-d",$goods['last_update'])?> &nbsp
                                            <i class="icon wb-eye" aria-hidden="true"></i> <?= $goods['click_count']?>
                                        </span>
                                        <p class="description"><?= $goods['goods_name']?></p>
                                        <p style="margin-top: 30px"><a href="<?= $src?>" target="_blank" class="btn btn-danger btn-block btn-lg">点击查看全景</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif;?>
                <!--       头部效果图结束         -->
                <div class="met-showproduct-body">
                    <div class="container">
                        <div class="row no-space">
                            <!--      左侧开始         -->
                            <div class="col-md-9 product-content-body">
                                <div class="row">
                                    <div class="panel product-detail">
                                        <div class="panel-body">
                                            <ul class="nav nav-tabs nav-tabs-line met-showproduct-navtabs affix-nav">
                                                <li class="active">
                                                    <a data-toggle="tab" href="#product-details" data-get="product-details">详细信息</a>
                                                </li>
                                            </ul>
                                            <div class="tab-content">
                                                <div class="goods-common">
                                                    <p style="margin-top:10px;padding:0 20px;"><img src="http://hjzhome.image.alimmdn.com/%E9%A6%96%E9%A1%B5%E5%9B%BE%E7%89%87/%E8%AF%A6%E6%83%85%E9%A1%B5%E8%AD%A6%E7%A4%BA%E5%9B%BE790.jpg?t=1536113689399" style="width:100%;height:auto"></p>
                                                    <p style="margin-top:10px;padding:0 20px;"><img src="http://hjzhome.image.alimmdn.com/%E8%AF%A6%E6%83%85%E9%A1%B5/22.jpg" style="width:100%;height:auto"></p>
                                                </div>
                                                <?php foreach ($res as $v):?>
                                                    <div><?= $v?></div>
                                                <?php endforeach;?>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--      左侧结束         -->
                            <!--右侧开始-->
                            <div class="col-md-3">
                                <div class="row">
                                    <div class="panel product-hot">
                                        <div class="panel-body">
                                            <h4 class="example-title">热门推荐</h4>
                                            <ul class="blocks-2 blocks-sm-3 mob-masonry" data-scale='1'>
                                                <?php foreach ($vrres as $v):?>
                                                    <li>
                                                        <a href="<?= Url::toRoute(['goods','goods_id'=>$v['goods_id']])?>" target="_self" class="img" title="<?= $v['goods_name']?>">
                                                            <img class="swiper-lazy" data-src='<?= $v['goods_img']?>' alt="<?= $v['goods_name']?>">
                                                        </a>
                                                        <a href="<?= Url::toRoute(['goods','goods_id'=>$v['goods_id']])?>" target="_self" class="txt" title="<?= $v['goods_name']?>"><?= mb_strrchr($v['goods_name'],'预',true)?></a>
                                                    </li>
                                                <?php endforeach;?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--右侧结束-->
                        </div>
                    </div>
                </div>
            </div>
            <!--  公共底栏  -->
            <?php $this->beginContent('@app/views/layouts/hjz/side-foot.php') ?><?php $this->endContent() ?>
            <input type="hidden" name="lazyloadbg" value="base64">
        </div>
    </div>
    <div class="side-scroll swiper-scrollbar"></div>
</div>

<script src="/static/demo/metinfos.js"></script>
<script>
$(function () {
    //1秒后加载全景图
    setTimeout(function () {
        var src = $("#effect-pic").data("src");
        $("#effect-pic").attr("src",src);
    },1000);
})
</script>
</body>
</html>