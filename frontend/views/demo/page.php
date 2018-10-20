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
    <meta name="generator" content="hjzhome"  data-variable="https://show.metinfo.cn/muban/M1156010/328/,cn,25,,7,M1156010" />
</head>
<body class="class-25">
<style>
    .swiper-slide{margin-bottom: 20px}
    
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
                <a href="<?= Url::toRoute(['demo/about'])?>"  title="全部">
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
        <div class="side-body swiper-lazy" data-background="http://hjzhome.image.alimmdn.com/hjzWebsite/背景图/18.jpg">
            <section class="met-show animsition">
                <div class="container">
                    <div class="row">
                        <div class="met-editor lazyload clearfix">
                            <div class="main-content">
                                <p class="b"><?= $content['keywords']?></p><p class="p"><?= $content['title']?></p>
                                <?= $content['intro']?>
                            </div>

                        </div>
                    </div>
                </div>
            </section>
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