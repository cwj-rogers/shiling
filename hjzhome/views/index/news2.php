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
    <meta name="generator" content="MetInfo 5.3.19"  data-variable="https://show.metinfo.cn/muban/M1156010/328/,cn,108,,2,M1156010" />
</head>
<body class="  class-108">

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
            <li class="sign-li <?= Yii::$app->request->get('type')? '':'active'?>">
                <a href="<?= Url::toRoute(['news'])?>"  title="全部">
                    <b>全部</b>
                </a>
            </li>
            <li class="sign-li <?= Yii::$app->request->get('type')==89? 'active':''?>">
                <a href="<?= Url::toRoute(['news','type'=>89])?>"  title="新家宝典">
                    <b>新家宝典</b>
                </a>
            </li>
            <li class="sign-li <?= Yii::$app->request->get('type')==88? 'active':''?>">
                <a href="<?= Url::toRoute(['news','type'=>88])?>"  title="家装攻略">
                    <b>家装攻略</b>
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
        <div class="side-body swiper-lazy" data-background="http://hjzhome.image.alimmdn.com/hjzWebsite/背景图/2.jpg">
            <section class="met-news animsition type-0">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 met-news-body">
                            <div class="row">
                                <div class="met-news-list">
                                    <ul class="met-page-ajax" data-scale=''>
                                        <?php foreach ($article as $k=>$v):?>
                                        <li class="news-li">
                                            <div class="news-img">
                                                <a href="<?= Url::toRoute(['shownews','artid'=>$v['article_id']])?>" title="<?= $v['title']?>" target='_self'>
                                                    <img class="swiper-lazy" data-src='<?= $v['file_url']?>'>
                                                </a>
                                            </div>
                                            <div class="news-text">
                                                <h3>
                                                    <a href="<?= Url::toRoute(['shownews','artid'=>$v['article_id']])?>" title="<?= $v['title']?>"><?= $v['title']?></a>
                                                </h3>
                                                <ul>
                                                    <li>
                                                        <i class="fa fa-clock-o"></i>
                                                        <b><?= date("Y-m-d",$v['add_time'])?></b>
                                                    </li>
                                                    <li>
                                                        <i class="fa fa-user-plus"></i>
                                                        <b><?= $v['author']?></b>
                                                    </li>
                                                    <li>
                                                        <i class="fa fa-eye"></i>
                                                        <b><?= $v['click']?></b>
                                                    </li>
                                                </ul>
                                                <p><?= $v['content']?></p>
                                                <em>
                                                    <b>标签：</b>
                                                    <a href="search/?searchword=微服务" title="微服务" target='_self'>荟家装学问课堂</a>
                                                    <a href="search/?searchword=微服务" title="微服务" target='_self'>新家宝典</a>
                                                    <a href="search/?searchword=微服务" title="微服务" target='_self'>家装攻略</a>
                                                </em>
                                                <a class="click-box" href="shownews.php?lang=cn&id=57" target='_self'>
                                                    <span>READ MORE</span>
                                                </a>
                                            </div>
                                        </li>
                                        <?php endforeach;?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="met-page-ajax-body visible-xs-block">
                            <button type="button" class="btn btn-default btn-block btn-squared ladda-button"
                                    id="met-page-btn" data-style="slide-left" data-url="/muban/M1156010/328/news/?lang=cn&class1=108&class2=0&class3=0&mbpagelist=1" data-page="1">
                                <a class="click-box">
                                    <span>READ MORE</span>
                                </a>
                            </button>
                        </div>
                        <div class="col-md-4">
                            <div class="row">
                                <div class="met-news-bar">
                                    <!--string(4) "news"
-->
                                    <div class="sidenews-lists">
                                        <h3>
                                            <span>为您推荐</span>
                                        </h3>
                                        <ul >
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
                <div class="hidden-xs">
                    <div class='met_pager'>
                        <span class='PreSpan'>«</span>
                        <a href="<?= Url::toRoute(['news'])?>">1</a>
                        <a href="<?= Url::toRoute(['news'])?>">2</a>
                        <a href="<?= Url::toRoute(['news'])?>" class='NextA'>»</a>
                        <span class='PageText'>转至第</span>
                        <input type='text' id='metPageT' data-pageurl='news.php?lang=cn&class1=108&page=||2' value='1' />
                        <input type='button' id='metPageB' value='页' />
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