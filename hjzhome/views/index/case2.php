<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/5 0005
 * Time: 下午 5:52
 */
use yii\helpers\Url;
?>
<!DOCTYPE HTML>
<html class="isMobile  ">
<head>
    <!--  头部文件  -->
    <?php $this->beginContent('@app/views/layouts/hjz/side-head.php') ?><?php $this->endContent() ?>
    <meta name="generator" content="hjzhome"  data-variable="https://show.metinfo.cn/muban/M1156010/328/,cn,109,,5,M1156010" />
</head>
<body class="  class-109">
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
                <a href="javascript:;"  title="全部">
                    <b>全部</b>
                </a>
            </li>
        </ul>
    </div>
</div>
<!--  内容  -->
<div class="side-content ">
    <div class="banner-sub auto not-has" data-height="420|350|200">
    </div>
    <div class="side-html">
        <div class="side-body swiper-lazy" data-background="http://hjzhome.image.alimmdn.com/hjzWebsite/背景图/9.jpg">
            <div class="met-img animsition imgs0">
                <div class="container">
                    <div class="row">
                        <div class="blocks-md-12 blocks-12 blocks-sm-12 product-li-first shown" style="padding-bottom: 25px">
                            <h1>~ 客户案例欣赏 ~</h1>
                            <p style="color: gray">平台坚持以最好的态度服务客户，秉承客户至上的服务精神，在整装服务路上彼此共勉</p>
                        </div>
                        <ul class="blocks-2 blocks-sm-3 blocks-md-4 blocks-xlg-4  met-page-ajax" data-scale='0.72222222222222'>
                            <?php foreach ($res as $v):?>
                                <li class="img-li">
                                    <span>
                                        <a href="<?= Url::toRoute(['goods','goods_id'=>$v['goods_id']])?>" title="<?= $v['goods_name']?>" target='_blank'>
                                            <img class="swiper-lazy" data-src='<?= $v['goods_thumb']?>' alt="<?= $v['goods_name']?>">
                                            <font><?= $v['goods_name']?></font>
                                        </a>
                                        <p class="fa fa-search met-img-showbtn" data-imglist="<?= $v['goods_name']?>*../upload/201707/1500542224.jpg|"></p>
                                    </span>
                                </li>
                            <?php endforeach;?>
                        </ul>
                    </div>
                </div>
                <div class="hide">
                    <div class='met_pager'>
                        <span class='PreSpan'>«</span>
                        <a href=../case/ class='Ahover'>1</a>
                        <a href=img.php?lang=cn&class1=109&page=2 >2</a>
                        <a href=img.php?lang=cn&class1=109&page=2 class='NextA'>»</a>
                        <span class='PageText'>转至第</span>
                        <input type='text' id='metPageT' data-pageurl='img.php?lang=cn&class1=109&page=||2' value='1' />
                        <input type='button' id='metPageB' value='页' />
                    </div>
                </div>
                <div class="met-page-ajax-body ">
                    <button type="button" class="btn btn-default btn-block btn-squared ladda-button"
                            id="met-page-btn" data-style="slide-left" data-url="<?= Url::toRoute('case',true)?>" data-url2="<?= Url::toRoute('goods',true)?>" data-page="1">
                        <a class="click-box">
                            <span>LOAD MORE</span>
                        </a>
                    </button>
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
</body>
</html>