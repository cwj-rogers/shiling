<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
use kartik\form\ActiveForm;
use yii\helpers\Html;
?>
<!DOCTYPE HTML>
<html class="isMobile  ">
<head>
    <!--  头部文件  -->
    <?php $this->beginContent('@app/views/layouts/hjz/side-head.php') ?><?php $this->endContent() ?>
    <meta name="generator" content="hjzhome"  data-variable="https://show.metinfo.cn/muban/M1156010/328/,cn,10001,,10001,M1156010" />
</head>
<body class="100011">

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
<div class="side-head nav-open1 active">
    <!--  品牌LOGO  -->
    <?php $this->beginContent('@app/views/layouts/hjz/side-logo.php') ?><?php $this->endContent() ?>
    <div class="sign-box">
        <ul class="sign-ul swiper-nav"></ul>
    </div>
</div>

<div class="window-box">
    <div class="window-cut">
        <div class="window-bin window-banner"
             data-hash="index"
             data-title="首页">
            <div class="banner-box">
                <div class="banner-cut" id="white-board">
                    <div class="banner-bin banner-lazy" data-background="http://hjzhome.image.alimmdn.com/hjzWebsite/背景图/21.jpg">
                        <div class="container  hjz-container1"><a href="<?= Url::toRoute(['about'])?>" target="_blank"></a></div>
                    </div>
                    <div class="banner-bin banner-lazy" data-background="http://hjzhome.image.alimmdn.com/hjzWebsite/背景图/2.jpg">
                        <div class="container hjz-container2"><a href="<?= Url::toRoute(['page','id'=>16])?>" target="_blank"></a></div>
                    </div>
                    <div class="banner-bin banner-lazy" data-background="http://hjzhome.image.alimmdn.com/hjzWebsite/背景图/7.jpg">
                        <div class="container hjz-container3"><a href="<?= Url::toRoute(['picture'])?>" target="_blank"></a></div>
                    </div>
                    <div class="banner-bin banner-lazy" data-background="http://hjzhome.image.alimmdn.com/hjzWebsite/背景图/19.jpg">
                        <div class="container hjz-container4"><a href="<?= Url::toRoute(['goods','goods_id'=>3439])?>" target="_blank"></a></div>
                    </div>
                </div>
                <div class="banner-pager"></div>
            </div>
            <div class="window-next">SCROLL</div>
        </div>

        <div class="window-bin swiper-lazy"
             data-hash="video"
             data-title="免费设计"
             data-background="http://hjzhome.image.alimmdn.com/hjzWebsite/背景图/20.jpg">
            <div class="container video-box">
                <div class="row">
                    <div class="video-left active">
                        <div class="video-content video">
                            <div class="message-subpage">
                                <h3>
                                    <u>免费设计 </u>装修第一步免费全景效果图看家
                                </h3>
                                <form method="post" class="met-form met-form-validation fv-form fv-form-bootstrap" action="<?=Url::toRoute(['free'])?>" novalidate="novalidate"><button type="submit" class="fv-hidden-submit" style="display: none; width: 0px; height: 0px;"></button>
                                    <input type="hidden" name="lang" value="cn">
                                    <div class="form-group ftype_input">
                                        <div>
                                            <label for="" class="label"><em class="label_start">* </em>所在城市：</label>
                                            <!--下拉列表-->
                                            <?=Html::dropDownList('province',null,[],['class'=>'form-control apply-prov','id'=>"hjz-province"])?>
                                            <?=Html::dropDownList('city',null,[],['class'=>'form-control apply-city','id'=>"hjz-city"])?>
                                            <!--转中文-->
                                            <input type="hidden" name="py2cn">
                                        </div>
                                        <small class="help-block" data-fv-validator="notEmpty" data-fv-for="para115" data-fv-result="NOT_VALIDATED" style="display: none;">不能为空</small>
                                    </div>
                                    <div class="form-group ftype_input">
                                        <div>
                                            <label for="" class="label"><em class="label_start">* </em>房屋面积：</label>
                                            <input name="area" class="form-control" type="text" placeholder="房屋面积 " data-fv-notempty="true" data-fv-message="不能为空" data-fv-field="para115">
                                        </div>
                                        <small class="help-block" data-fv-validator="notEmpty" data-fv-for="para115" data-fv-result="NOT_VALIDATED" style="display: none;">不能为空</small>
                                    </div>
                                    <div class="form-group ftype_input">
                                        <div>
                                            <label for="" class="label"><em class="label_start">* </em>姓名：</label>
                                            <input name="name" class="form-control" type="text" placeholder="姓名 " data-fv-notempty="true" data-fv-message="不能为空" data-fv-field="para115">
                                        </div>
                                        <small class="help-block" data-fv-validator="notEmpty" data-fv-for="para115" data-fv-result="NOT_VALIDATED" style="display: none;">不能为空</small>
                                    </div>
                                    <div class="form-group ftype_input">
                                        <div>
                                            <label for="" class="label"><em class="label_start">* </em>手机号：</label>
                                            <input name="phone" class="form-control" type="text" placeholder="电话 " data-fv-notempty="true" data-fv-message="不能为空" data-fv-field="para116">
                                        </div>
                                        <small class="help-block" data-fv-validator="notEmpty" data-fv-for="para116" data-fv-result="NOT_VALIDATED" style="display: none;">不能为空</small>
                                    </div>
                                    <div class="submint">
                                        <button type="submit" class="btn btn-primary btn-block btn-squared more-box"><span>提 交</span></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="video-text">
                            <h3> 获取新家装修预算</h3>
                            <ul>
                                <li>
                                    <b>材料费</b><span class="offer1">28888</span> <i>元</i>
                                </li>
                                <li>
                                    <b>人工费</b><span class="offer2">12222</span> <i>元</i>
                                </li>
                                <li>
                                    <b>设计费</b><span class="offer3">3888</span> <i>元</i>
                                </li>
                                <li>
                                    <b>质检费</b><span class="offer4">2333</span> <i>元</i>
                                </li>
                            </ul>
                            <p> 装修预算数据由 <span>荟家装健康智慧整装</span> 平台历史服务上千万业主装修数据、全国各个城市线下门店合同成交金额经过大数据实时分析计算。</p>
                            <a class="click-box small" href="<?= Url::toRoute(['page','id'=>16])?>" title="免费设计报价" target='_self'>
                                <span>READ MORE</span>
                            </a>
                        </div>
                    </div>
                    <div class="video-right">
                        <div class="video-list" data-autoplay="1">
                            <ol class="video-ol">
                                <?php foreach ($vr as $k=>$v):?>
                                    <?php if ($k<5):?>
                                    <li class="video-li active" title=" <?= $v['goods_name']?>">
                                        <img class="video-lazy" data-src='<?= $v['img_url']?>' alt="<?= $v['goods_name']?>">
                                        <span>
                                            <a href="<?= Url::toRoute(['picture','id'=>$v['goods_id']])?>" title="<?= $v['goods_name']?>" target='_self'> <?= $v['goods_name']?></a>
                                        </span>
                                    </li>
                                    <?php endif;?>
                                <?php endforeach;?>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="window-next">SCROLL</div>
        </div>

        <div class="window-bin swiper-lazy"
             data-hash="about"
             data-title="关于"
             data-background="http://hjzhome.image.alimmdn.com/hjzWebsite/背景图/20.jpg">
            <div class="container about-box">
                <div class="row">
                    <div class="about-left">
                        <h3>
                            <font>HJZHOME HEALTH WISDOM COMPLETE PLATFORM</font>
                            <span>
                                <u>荟家装</u>健康智慧整装平台
                            </span>
                        </h3>
                        <ul>
                            <li>
                                <strong>
                                    <hr class="n1">
                                    <hr class="n1">
                                </strong>
                                <font>个</font>
                                <span>主营风格套餐</span>
                            </li>
                            <li>
                                <strong>
                                    <hr class="n4">
                                    <hr class="n9">
                                    <hr class="n2">
                                    <hr class="n1">
                                </strong>
                                <font>套</font>
                                <span>精品案例数</span>
                            </li>
                            <li>
                                <strong>
                                    <hr class="n1">
                                    <hr class="n1">
                                </strong>
                                <font>个</font>
                                <span>覆盖全国省份</span>
                            </li>
                            <li>
                                <strong>
                                    <hr class="n3">
                                    <hr class="n6">
                                </strong>
                                <font>个</font>
                                <span>全国线下门店</span>
                            </li>
                        </ul>
                        <p>深圳市荟家装科技有限公司（简称：荟家装），创立于2016年5月，总部位于中国佛山智慧新城，是一家专注于装修、建材、家居宅配的整体家装交易管理平台。荟家装以互联网渠道和金融杠杆助推F2C(工厂直接到消费者)模式迅速落地，打造国内领先的家居行业服务平台，在为客户带来更好家装体验的同时，积极推动整个家装行业“互联网+”的发展。</p>
                        <a class="click-box" href="about/" target='_self'>
                            <span>READ MORE</span>
                        </a>
                    </div>
                    <div class="about-right">
                        <div class="about-list">
                            <ul class="about-ul">
                                <li class="about-li">
                                    <img class="about-lazy" data-src='http://hjzhome.image.alimmdn.com/hjzWebsite/%E9%A6%96%E9%A1%B5%E5%9B%BE/mentou.jpg?t=1539155056000'>
                                </li>
                                <li class="about-li">
                                    <img class="about-lazy" data-src='http://hjzhome.image.alimmdn.com/hjzWebsite/%E9%A6%96%E9%A1%B5%E5%9B%BE/zhaoshang.jpg?t=1539155056000'>
                                </li>
                                <li class="about-li">
                                    <img class="about-lazy" data-src='http://hjzhome.image.alimmdn.com/hjzWebsite/%E9%A6%96%E9%A1%B5%E5%9B%BE/neibu.jpg?t=1539155056000'>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="about-click">
                        <a class="click-box" href="<?= Url::toRoute(['about'])?>" target='_self'>
                            <span>READ MORE</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="window-next">SCROLL</div>
        </div>

        <div class="window-bin swiper-lazy"
             data-hash="picture"
             data-title="产品"
             data-background="http://hjzhome.image.alimmdn.com/hjzWebsite/%E8%83%8C%E6%99%AF%E5%9B%BE/14.jpg?t=1539163663000">
            <div class="container">
                <div class="row">
                    <!--  轮播图  -->
                    <div id="section-A">
                        <div class="swiper-container gallery-top" id="container-box">
                            <div class="swiper-wrapper">
                                <?php foreach ($vr as $k=>$v):?>
                                    <div class="swiper-slide" data-thumb="<?= $v['goods_img']?>">
                                        <div class="A-body-content">
                                            <div class="bc-left">
                                                <h3><?= $v['goods_name']?> <span class="small">不足70m²按70m²计</span></h3>
                                                <div class="scheme-box">
                                                    <div class="scheme">
                                                        <div class="sch-title">方案</div>
                                                        <div class="sch-content"><?= $v['market_price']?>/m²整装包</div>
                                                    </div>
                                                </div>
                                                <ul>
                                                    <li>原木色/灰色/纯白色</li>
                                                    <li>年轻 浪漫</li>
                                                    <li>小清新人群</li>
                                                </ul>
                                                <div class="button-box">
                                                    <button><a href="<?= Url::toRoute(['picture'])?>" target="_blank">查看更多</a></button>
                                                    <button><a href="<?= Url::toRoute(['goods','goods_id'=>$v['goods_id']])?>" title="查看详情" target="_blank">产品详情</a></button>
                                                </div>
                                            </div>
                                            <div class="bc-right">
                                                <a href="<?= $v['provider_name']?>" target="_blank">
                                                    <div class="vr-pic">
                                                        <img src="<?= $v['img_url']?>" alt="">
                                                    </div>
                                                </a>
                                                <div class="vr-icon"></div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach;?>
                            </div>
                            <!-- Add Arrows -->
                            <div class="swiper-button-next swiper-button-white"></div>
                            <div class="swiper-button-prev swiper-button-white"></div>
                        </div>
                        <!-- Add Pagination -->
                        <div class="gallery-thumbs swiper-pagination"></div>
                    </div>
                </div>
            </div>
            <div class="window-next">SCROLL</div>
        </div>


        <div class="window-bin swiper-lazy"
             data-hash="case"
             data-title="案例"
             data-background="http://hjzhome.image.alimmdn.com/hjzWebsite/背景图/14.jpg">
            <div class="container case-box hjz-case">
                <div class="row">
                    <div class="case-left">
                        <h3>
                            <u>案例欣赏 </u>事实说话!
                        </h3>
                        <p>凭借拔尖的团队、优秀的业务能力，荟家装迅速成长为国内整装市场的弄潮者。我们专注打造互联网+智慧整装平台，利用互联网对施工/主材/软装/核算/监督进行信息化管理，从根本上解决整个家装过程管控五续的通病。</p>
                        <a class="click-box" href="case/" target='_self'>
                            <span>READ MORE</span>
                        </a>
                    </div>
                    <div class="case-right">
                        <div class="case-list">
                            <ul class="case-ul">
                                <li class="case-li case-null swiper-slide-active"></li>
                                <?php foreach ($case as $k=>$v):?>
                                <li class="case-li">
                                    <?php foreach ($v as $vv):?>
                                    <span>
                                        <a href="<?= Url::toRoute(['case','id'=>$vv['goods_id']])?>" title="<?= $vv['goods_name']?>" target='_blank'>
                                            <img class="case-lazy" data-src='<?= $vv['goods_thumb']?>' alt="<?= $vv['goods_name']?>">
                                            <font><?= $vv['goods_name']?></font>
                                        </a>
                                        <p class="fa fa-search met-img-showbtn" data-imglist="<?= $vv['goods_name']?>*upload/201707/1500542224.jpg|"></p>
                                    </span>
                                    <?php endforeach;?>
                                </li>
                                <?php endforeach;?>
                            </ul>
                        </div>
                    </div>
                    <div class="case-ctrl">
                        <div class="ctrl-left"></div>
                        <div class="ctrl-right"></div>
                    </div>
                </div>
            </div>
            <div class="window-next">SCROLL</div>
        </div>

        <!--   新闻资讯  -->
        <div class="window-bin swiper-lazy"
             data-hash="info"
             data-title="资讯"
             data-background="http://hjzhome.image.alimmdn.com/hjzWebsite/背景图/6.jpg" >
            <div class="container info-box">
                <div class="row">
                    <div class="info-left">
                        <?php foreach ($article as $k=>$v):?>
                            <div data-id="<?= $k?>" class="info-first info-ease <?= $k?:'active'?>">
                                <div class="info-img">
                                    <a href="<?= Url::toRoute(['shownews','artid'=>$v[0]['article_id']])?>" title="<?= $v[0]['title']?>" target='_blank'>
                                        <img class="swiper-lazy" data-src='<?= $v[0]['file_url']?>'>
                                    </a>
                                </div>
                                <div class="info-text">
                                    <h3>
                                        <a href="<?= Url::toRoute(['shownews','artid'=>$v[0]['article_id']])?>" title="<?= $v[0]['title']?>" target='_blank'><?= $v[0]['title']?></a>
                                    </h3>
                                    <ul>
                                        <li>
                                            <i class="fa fa-clock-o"></i>
                                            <b><?= date("Y-m-d H:i:s",$v[0]['add_time'])?></b>
                                        </li>
                                        <li>
                                            <i class="fa fa-user-plus"></i>
                                            <b><?= $v[0]['author']?></b>
                                        </li>
                                        <li>
                                            <i class="fa fa-eye"></i>
                                            <b><?= $v[0]['click']?></b>
                                        </li>
                                    </ul>
                                    <p style="text-indent:2em;"><?= $v[0]['content']?></p>
                                    <em>
                                        <b>标签：</b>
                                        <a href="<?= Url::toRoute(['news'])?>" title="装修课堂" target='_blank'>荟家装学问课堂</a>
                                        <a href="<?= Url::toRoute(['news','type'=>89])?>" title="装修课堂" target='_blank'>新家宝典</a>
                                        <a href="<?= Url::toRoute(['news','type'=>88])?>" title="装修课堂" target='_blank'>家装攻略</a>
                                    </em>
                                    <a class="click-box" href="<?= Url::toRoute(['news'])?>" target='_blank'>
                                        <span>READ MORE</span>
                                    </a>
                                </div>
                            </div>
                        <?php endforeach;?>
                    </div>
                    <div class="info-right">
                        <h3>
                            <u>装修资讯 · </u>让生活更简单
                        </h3>
                        <div class="info-nav">
                            <p>
                                <b data-href="<?= Url::toRoute(['news'])?>" data-id="<?= $artType[0]?>" title="装修资讯-全部（双击跳转）" class="active">
                                    <span>&radic;</span>
                                    <span>全部</span>
                                </b>
                                <b data-href="<?= Url::toRoute(['news','type'=>89])?>" data-id="<?= $artType[1]?>" title="新家宝典（双击跳转）">
                                    <span>&radic;</span>
                                    <span>新家宝典</span>
                                </b>
                                <b data-href="<?= Url::toRoute(['news','type'=>88])?>" data-id="<?= $artType[2]?>" title="家装攻略（双击跳转）">
                                    <span>&radic;</span>
                                    <span>家装攻略</span>
                                </b>
                            </p>
                        </div>
                        <div class="info-cut">
                            <?php foreach ($article as $k=>$v):?>
                                <div data-id="<?= $k?>" class="info-list info-ease <?= $k?:'active'?>">
                                    <ul class="info-ul">
                                        <?php foreach ($v as $kk=>$vv):?>
                                            <li class="info-li swiper-slide-active">
                                                <p>
                                                    <img class="info-lazy" data-src="<?= $vv['file_url']?>" alt="<?= $vv['title']?>">
                                                    <a href="<?= Url::toRoute(['shownews','artid'=>$vv['article_id']])?>" title="<?= $vv['title']?>" target='_blank'><?= $vv['title']?></a>
                                                    <b><?= date("Y-m-d",$vv['add_time'])?></b>
                                                </p>
                                            </li>
                                        <?php endforeach;?>
                                    </ul>
                                </div>
                            <?php endforeach;?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="window-next">SCROLL</div>
        </div>

        <div class="window-bin swiper-lazy"
             data-hash="contact"
             data-title="联系"
             data-background="http://hjzhome.image.alimmdn.com/hjzWebsite/背景图/12.jpg" >
            <div class="container contact-box">
                <div class="row">
                    <div class="contact-left" id="map" coordinate="113.063379,23.013639"></div>
                    <div class="contact-right">
                        <div class="contact-cut">
                            <div class="contact-bin">
                                <h2>全国统一服务热线：</h2>
                                <h1>400-6966-398</h1>
                                <p>
                                    <em class="fa fa-cloud-download"></em>
                                    <span>广东省佛山市禅城区季华路智慧新城T15栋10楼</span>
                                </p>
                                <p>
                                    <em class="fa fa-tty"></em>
                                    <span>400-6966-398 / 18676036969</span>
                                </p>
                                <p>
                                    <em class="fa fa-envelope"></em>
                                    <span>001@hjzhome.com</span>
                                </p>
                            </div>
                            <div class="contact-bin">
                                <dl>
                                    <dt>
                                        <img class="swiper-lazy" data-size="120_120" data-src="http://hjzhome.image.alimmdn.com/hjzWebsite/首页图/微信服务号.jpg">

                                    </dt>
                                    <dd>
                                        <strong>
                                            <font>扫一扫</font>
                                            <em class="fa fa-desktop"></em>
                                            <em class="fa fa-tablet"></em>
                                            <em class="fa fa-mobile"></em>
                                        </strong>
                                        <span>
					                        拿起手机扫描二维码，即可时刻关注我们！&nbsp;
                                            <br>
					                        公众号名称：<u>荟家装健康智慧整装</u>&nbsp;
                                             <br>
                                            微信号：<u>hjzhome88</u>&nbsp;
                                            </span>
                                    </dd>
                                </dl>
                                <a class="click-box" href="<?= Url::toRoute(['about'])?>" target='_self'>
                                    <span>READ MORE</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="window-next">SCROLL</div>
        </div>
        <div class="window-bin foot">
            <!--  公共底栏  -->
            <?php $this->beginContent('@app/views/layouts/hjz/side-foot.php') ?><?php $this->endContent() ?>
            <input type="hidden" name="lazyloadbg" value="base64">
        </div>
    </div>
</div>

<script src="/static/demo/metinfos.js?v=123"></script>
<script>
    /* VR轮播图 */
    $(document).ready(function () {
        var vrProduct = new Swiper('#container-box', {
            pagination: '.gallery-thumbs',
            paginationClickable: true,
            paginationBulletRender: function (swiper, index, className) {
                var thumb,url;
                url = $("#container-box").find(".swiper-slide:eq("+(index+1)+")").data("thumb");
                thumb = '<div class="' + className + '" style="background-image:url(' + url + ');background-size:100% 100%;"></div>';
                return thumb;
            },
            prevButton: '.swiper-button-prev',
            nextButton: '.swiper-button-next',
            initialSlide: 0,
            effect: 'fade',
            spaceBetween: 0,
            loop: true, //环路,无缝模式
            autoplay:3000,
        });
    });

    //百度地图标志
    function coordinate_func() {
        var script = document.createElement('script'),
            coordinate = $('#map').attr('coordinate') || '105,25';
        script.src = '//api.map.baidu.com/api?v=2.0&ak=gnFREoDcGvimV2KZOmSPIy1fNPE5IgdH&callback=map_func';
        document.body.appendChild(script);
        map_func = function () {
            console.log(BMap);
            var coo = coordinate && coordinate.split(',');
            var map = new BMap.Map('map');//实例化地图对象
            map.centerAndZoom(new BMap.Point(coo[0] * 1, coo[1] * 1), 19);//地图对象设置地图中心
            map.enableScrollWheelZoom();//地图对象禁止缩放地图

            var Icon = new BMap.Icon(M['tem'] + "/min/svg/point.svg\" class=\"point_svg", new BMap.Size(28, 56));//实例化ICON对象
            var marker = new BMap.Marker(new BMap.Point(coo[0] * 1, coo[1] * 1), {icon: Icon,});//实例化标识对象
            marker.setAnimation(BMAP_ANIMATION_BOUNCE);//标识对象设置动画属性
            map.addOverlay(marker);//添加覆盖物

            var sContent = "<h4 style='margin:0 0 5px 0;padding:0.2em 0'>深圳市荟家装科技有限公司</h4>" +
                "<img style='float:right;margin:4px' id='imgDemo' src='http://hjzhome.image.alimmdn.com/hjzWebsite/首页图/红底LOGO+500px.png' width='100' height='100' title='深圳市荟家装科技有限公司'/>" +
                "<p style='margin:0;line-height:1.5;font-size:13px;text-indent:2em'>广东省佛山市禅城区季华路智慧新城T15栋10楼（佛山总部）</p>";
            var opts = {
                offset : {width:0,height:-40}
            }
            var infoWindow = new BMap.InfoWindow(sContent,opts);//实例化窗口对象
            infoWindow.enableAutoPan();

            marker.openInfoWindow(infoWindow);//标识对象设置信息窗口
        }
    }

    /*省份城市二级联动*/
    var region=function(){};
    region.response = function(result){
        var sel = document.getElementById(result.target);
        sel.length = 1;
        sel.selectedIndex = 0;
        sel.style.display = (result.regions.length == 0 && result.type + 0 == 3) ? "none" : '';
        if (document.all){
            sel.fireEvent("onchange");
        }
        else{
            var evt = document.createEvent("HTMLEvents");
            evt.initEvent('change', true, true);
            sel.dispatchEvent(evt);
        }
        if (result.regions){
            for (i = 0; i < result.regions.length; i ++ )
            {
                var opt = document.createElement("OPTION");
                opt.value = result.regions[i].region_id;
                opt.text  = result.regions[i].region_name;
                sel.options.add(opt);
            }
        }
    };
    region.loadProvinces = function(county,classname){
        var url = "http://mall.hjzhome.com/region.php?type=1&target=hjz-province&parent="+county+"&1539314969773773";
        $.getJSON('http://'+location.host+'/index/region',{url:url},function(data){
            region.response(data);
        })
    };
    region.loadCities = function(provinces,classname){
        var url = "http://mall.hjzhome.com/region.php?type=2&target=hjz-city&parent="+provinces+"&1539314969774774";
        $.getJSON('http://'+location.host+'/index/region',{url:url},function(data){
            region.response(data);
        })
    };
    region.changed = function(obj,selName){
        var parent = obj.options[obj.selectedIndex].value;
        region.loadCities(parent,"hjz-city");
    };

    $(document).ready(function(){
        //弹窗获取地区列表
        region.loadProvinces(1,"hjz-province");//获取省份列表
        region.loadCities(6,"hjz-city");//获取城市列表
        setTimeout(function () {
            //默认选中地区
            $("#hjz-province option[value='6']").prop("selected","selected");
            $("#hjz-city option[value='80']").prop("selected","selected");
        },1500);
        $('#hjz-province,#hjz-city').change(function () {
            if ($(this).attr("id")=="hjz-province"){
                //绑定下拉事件
                var selectid = $(this).val();
                if(selectid>0){
                    var obj = document.getElementById("hjz-province");
                    region.changed(obj,"hjz-city");
                }
            }

            //拼接城市
            var pro = $("#hjz-province").find("option:selected").text() || "广东";
            var city = $("#hjz-city").find("option:selected").text() || "佛山";
            $("input[name=py2cn]").val(pro+','+city);
        });

        //预估报价动画效果
        setInterval(function(){
            $('.offer1').text(Math.round(Math.random()*80000 + 20000));
            $('.offer2').text(Math.round(Math.random()*10000 + 10000));
            $('.offer3').text(Math.round(Math.random()*6000 + 2000));
            $('.offer4').text(Math.round(Math.random()*3500 + 500));
        },500);
    })
</script>
</body>
</html>
