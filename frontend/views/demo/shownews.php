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
    <meta name="generator" content="hjzhome"
          data-variable="https://show.metinfo.cn/muban/M1156010/328/,cn,115,55,2,M1156010"/>
</head>
<body class="class-115">

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
<div class="side-head nav-open1">
    <!--  品牌LOGO  -->
    <?php $this->beginContent('@app/views/layouts/hjz/side-logo.php') ?><?php $this->endContent() ?>
    <div class="sign-box">
        <ul class="sign-ul swiper-nav">
            <li class="sign-li">
                <a href="<?= Url::toRoute(['news'])?>"  title="全部">
                    <b>全部</b>
                </a>
            </li>
            <li class="sign-li <?= $article['article_type']==89? 'active':''?>">
                <a href="<?= Url::toRoute(['news','type'=>89])?>"  title="新家宝典">
                    <b>新家宝典</b>
                </a>
            </li>
            <li class="sign-li <?= $article['article_type']==88? 'active':''?>">
                <a href="<?= Url::toRoute(['news','type'=>88])?>"  title="家装攻略">
                    <b>家装攻略</b>
                </a>
            </li>
        </ul>
    </div>
</div>
<div class="side-content ">
    <div class="banner-sub auto not-has" data-height="420|350|200"></div>
    <div class="side-html">
        <div class="side-body swiper-lazy"
             data-background="http://hjzhome.image.alimmdn.com/hjzWebsite/背景图/14.jpg">
            <section class="met-shownews animsition">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 met-shownews-body">
                            <div class="row">
                                <div class="met-shownews-header">
                                    <h1><?= $article['title']?></h1>
                                    <div class="info">
                                        <span>
                                            <i class="fa fa-clock-o"></i>
                                             <?= date("Y-m-d",$article['add_time'])?>
                                        </span>
                                        <span>
                                            <i class="fa fa-user-plus"></i> <?= $article['author']?>
                                        </span>
                                        <span>
                                            <i class="icon wb-eye margin-right-5" aria-hidden="true"></i>
                                            <?= $article['click']?>
                                        </span>
                                    </div>
                                </div>
                                <div class="met-editor lazyload clearfix">
                                    <?= $article['content']?>
                                </div>
<!--                                <div class="met-shownews-footer">-->
<!--                                    <ul class="pager pager-round">-->
<!--                                        <li class="previous ">-->
<!--                                            <a href="shownews.php?lang=cn&id=56" title="Zdal分库分表：支付宝是如何在分布式环境下完爆数据库压力的？">-->
<!--                                                上一篇-->
<!--                                                <span aria-hidden="true" class='hidden-xs'>：Zdal分库分表：支付宝是如何在分布式环境下完爆数据库压力的？</span>-->
<!--                                            </a>-->
<!--                                        </li>-->
<!--                                        <li class="next ">-->
<!--                                            <a href="shownews.php?lang=cn&id=53" title="ECMAScript 8都发布了，你还没有用上ECMAScript 6？">-->
<!--                                                下一篇-->
<!--                                                <span aria-hidden="true" class='hidden-xs'>：ECMAScript 8都发布了，你还没有用上ECMAScript 6？</span>-->
<!--                                            </a>-->
<!--                                        </li>-->
<!--                                    </ul>-->
<!--                                </div>-->
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row">
                                <div class="met-news-bar">
                                    <div class="sidenews-lists">
                                        <h3>
                                            <span>为您推荐</span>
                                        </h3>
                                        <ul>
                                            <?php foreach ($artRList as $k=>$v):?>
                                                <li>
                                                    <a href="<?= Url::toRoute(['shownews','artid'=>$v['article_id']])?>" title="<?= $v['title']?>" target='_self'>
                                                        <img class="swiper-lazy" data-src="<?= $v['file_url']?>">
                                                        <b><?= $v['title']?></b>
                                                        <p><?= date("Y-m-d",$v['add_time'])?></p>
                                                    </a>
                                                </li>
                                            <?php endforeach;?>
                                        </ul>
                                    </div>
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

<script src="/static/demo/metinfos.js?v=123"></script>
</body>
</html>