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
    <!--  头部文件  -->
    <?php $this->beginContent('@app/views/layouts/hjz/side-head.php') ?><?php $this->endContent() ?>
    <meta name="generator" content="MetInfo 5.3.19"  data-variable="https://show.metinfo.cn/muban/M1156010/328/,cn,107,,3,M1156010" />
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
                <a href="javascript:;"  title="全部">
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
                                <p style="color: gray">自然界负离子3大功效 1.除甲醛（除甲醛除苯效果高达90%以上，让装修头号杀手无处匿藏！）2.祛异味（消除洗手间不适异味，减少细菌滋生，让空气充满清新！）3.净化空气（快速吸收和强效清除二手烟，厨房烟雾污染，呵护全家健康！） 足不出户，坐享负离子健康生活。</p>
                                <p style="color: gray">平台保证材料采用天然矿物原料，可持续产生大量负离子，释放空气当中可有效降解空气的各种有毒物质，形成纯净空气</p>
<!--                                <span class="btn-default">-->
<!--                                    <a class="click-box" title="APP开发" href="../picture/product.php?lang=cn&class2=111">-->
<!--                                        <span>READ MORE</span>-->
<!--                                    </a>-->
<!--                                </span>-->
                            </li>
                            <?php foreach ($vrres as $k=>$v):?>
                            <li class=" product-li shown">
                                <a href="<?= Url::toRoute(['goods','goods_id'=>$v['goods_id']])?>" title="<?= $v['goods_name']?>" target='_blank'>
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