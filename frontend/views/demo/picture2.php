<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/5 0005
 * Time: 下午 5:50
 */
use yii\helpers\Url;
?>
<!DOCTYPE HTML>
<html class="isMobile  ">
<head>
    <title>产品中心-APP应用开发|网站建设|平面设计</title>
    <meta name="renderer" content="webkit">
    <meta charset="utf-8" />
    <meta http-equiv="Cache-Control" content="no-siteapp">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="generator" content="MetInfo 5.3.19"  data-variable="https://show.metinfo.cn/muban/M1156010/328/,cn,107,,3,M1156010" />
    <meta name="format-detection" content="email=no" />
    <meta name="format-detection" content="telephone=no" />
    <meta name="full-screen" content="yes">
    <meta name="x5-fullscreen" content="true">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="description" content="APP技术原本是对软件进行加速运算或进行大型科学运算的技术，基于Paas开发平台开发出的APP，直接部署在云环境上，形成一种租用云服务的模式。" />
    <meta name="keywords" content="APP应用开发|网站建设|平面设计" />
    <link href="http://hjzhome.image.alimmdn.com/hjzWebsite/首页图/红底LOGO+500px.png" rel="shortcut icon" type="image/x-icon" />
    <link rel='stylesheet' href='/static/demo/metinfos.css'>
</head>
<body class="  class-107">
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
                <a href="../picture/"  title="全部">
                    <b>全部</b>
                </a>
            </li>
<!--            <li class="sign-li ">-->
<!--                <a href="../picture/product.php?lang=cn&class2=111"  title="APP开发">-->
<!--                    <b>APP开发</b>-->
<!--                </a>-->
<!--            </li>-->
<!--            <li class="sign-li ">-->
<!--                <a href="../picture/product.php?lang=cn&class2=112"  title="网站建设">-->
<!--                    <b>网站建设</b>-->
<!--                </a>-->
<!--            </li>-->
<!--            <li class="sign-li ">-->
<!--                <a href="../picture/product.php?lang=cn&class2=113"  title="平面设计">-->
<!--                    <b>平面设计</b>-->
<!--                </a>-->
<!--            </li>-->
        </ul>
    </div>
</div>
<!--  内容  -->
<div class="side-content ">
    <div class="banner-sub auto not-has" data-height="420|350|200">
    </div>
    <div class="side-html">
        <div class="side-body swiper-lazy" data-background="http://hjzhome.image.alimmdn.com/hjzWebsite/背景图/21.jpg">
            <div class="met-product animsition type-0">
                <div class="container">
                    <div class="row">
                        <ul class="blocks-2 blocks-sm-2 blocks-md-3 blocks-xlg-4  met-page-ajax met-grid" id="met-grid" data-scale='0.7182320441989'>
                            <li class="product-li margin-bottom-0"></li>
                            <li class="product-li-first shown">
                                <h1>~ 负离子健康整装套餐 ~</h1>
                                <p>APP软件开发指的是手机应用软件的开发与服务。这里的APP指的是应用程序application的意思。APP技术原本是对软件进行加速运算或进行大型科学运算的技术，基于Paas开发平台开发出的APP，直接部署在云环境上，为企业进行集成，形成一种租用云服务的模式。同时，APP技术还可以应用于移动互联网中。在移动时代的大背景下，个人应用率先走进云时代。</p>
<!--                                <span class="btn-default">-->
<!--                                    <a class="click-box" title="APP开发" href="../picture/product.php?lang=cn&class2=111">-->
<!--                                        <span>READ MORE</span>-->
<!--                                    </a>-->
<!--                                </span>-->
                            </li>
                            <?php foreach ($vrres as $k=>$v):?>
                            <li class=" product-li shown">
                                <a href="<?= Url::toRoute(['page','tmp'=>'good','id'=>$v['goods_id']])?>" title="<?= $v['goods_name']?>" target='_self'>
                                    <font>
                                        <img class="swiper-lazy"  alt="<?= $v['goods_name']?>" data-src='<?= $v['goods_img']?>'>
                                    </font>
                                    <span>
                                        <b><?= $v['goods_name']?></b>
                                    </span>
                                </a>
                                <p class="met-img-showbtn" data-imglist="<?= $v['goods_name']?>*../upload/201707/1500524230.jpg|<?= $v['goods_name']?>*../upload/201707/1500524427.jpg|<?= $v['goods_name']?>*../upload/201707/1500524289.jpg">+</p>
                            </li>
                            <?php endforeach;?>
                        </ul>
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
</body>
</html>