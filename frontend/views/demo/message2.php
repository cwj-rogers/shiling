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
    <title>联系我们-APP应用开发|网站建设|平面设计</title>
    <meta name="renderer" content="webkit">
    <meta charset="utf-8" />
    <meta http-equiv="Cache-Control" content="no-siteapp">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="generator" content="MetInfo 5.3.19"  data-variable="https://show.metinfo.cn/muban/M1156010/328/,cn,25,,7,M1156010" />
    <meta name="format-detection" content="email=no" />
    <meta name="format-detection" content="telephone=no" />
    <meta name="full-screen" content="yes">
    <meta name="x5-fullscreen" content="true">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="description" content="模板建站和纯手工建站的区别在于：模板是“成衣”，你只需要去服装店挑选，而所谓的纯手工建站是裁缝师傅给你定制。功能和稳定性模板+成熟的CMS管理后台大大优于“裁缝店”" />
    <meta name="keywords" content="APP应用开发|网站建设|平面设计" />
    <link href="https://show.metinfo.cn/muban/M1156010/328/favicon.ico" rel="shortcut icon" type="image/x-icon" />
    <link rel='stylesheet' href='/static/demo/metinfos.css'>
</head>
<body class="class-25">
<div class="load-box">
    <svg viewBox="0 0 120 120" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
        <g>
            <circle cx="35" cy="16.6987298" r="11"></circle>
            <circle cx="16.6987298" cy="35" r="11"></circle>
            <circle cx="10" cy="60" r="11"></circle>
            <circle cx="16.6987298" cy="85" r="11"></circle>
            <circle cx="35" cy="103.30127" r="11"></circle>
            <circle cx="60" cy="110" r="11"></circle>
            <circle cx="85" cy="103.30127" r="11"></circle>
            <circle cx="103.30127" cy="85" r="11"></circle>
            <circle cx="110" cy="60" r="11"></circle>
            <circle cx="103.30127" cy="35" r="11"></circle>
            <circle cx="85" cy="16.6987298" r="11"></circle>
            <circle cx="60" cy="10" r="11"></circle>
        </g>
    </svg>
</div>
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
            <li class="sign-li ">
                <a href="<?= Url::toRoute(['demo/about'])?>"  title="全部">
                    <b>全部</b>
                </a>
            </li>
            <li class="sign-li active">
                <a href="<?= Url::toRoute(['demo/message'])?>"  title="查看留言">
                    <b>查看留言</b>
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
                            <div class="form-group ftype_textarea">
                                <div>
                                    <?php if ($checkout):?>
                                    <textarea name='para118' class='form-control' placeholder='内容 ' rows='20'><?= $info?></textarea>
                                    <?php endif;?>
                                </div>
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
<script>
    $(function () {
        // prompt dialog
        <?php if (!$checkout):?>
        alertify.prompt("请输入查看留言密码", function (str, e) {
            // str is the input text
            if (e) {
                // user clicked "ok"
                location.href = location.href+"?password="+str;
            } else {
                history.back(-1);
            }
        }, "密码");
        <?php endif;?>
    })
</script>
</body>
</html>