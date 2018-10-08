<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
// 因为还没搞清楚模板的JS设计方式,放弃layout
//$this->beginPage();
?>
<!DOCTYPE HTML>
<html class="isMobile">
    <!-- BEGIN HEAD -->
    <head>
        <title>APP应用开发|网站建设|平面设计-APP应用开发|网站建设|平面设计</title>
        <meta name="renderer" content="webkit">
        <meta charset="utf-8" />
        <meta http-equiv="Cache-Control" content="no-siteapp">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <meta name="generator" content="MetInfo 5.3.19"  data-variable="https://show.metinfo.cn/muban/M1156010/328/,cn,10001,,10001,M1156010" />
        <meta name="format-detection" content="email=no" />
        <meta name="format-detection" content="telephone=no" />
        <meta name="full-screen" content="yes">
        <meta name="x5-fullscreen" content="true">
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="description" content="模板建站和纯手工建站的区别在于：模板是“成衣”，你只需要去服装店挑选，而所谓的纯手工建站是裁缝师傅给你定制。功能和稳定性模板+成熟的CMS管理后台大大优于“裁缝店”" />
        <meta name="keywords" content="APP应用开发|网站建设|平面设计" />
        <link href="https://show.metinfo.cn/muban/M1156010/328/favicon.ico" rel="shortcut icon" type="image/x-icon" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <?php $this->head() ?>
        <!-- END THEME LAYOUT STYLES -->
        <link rel='stylesheet' href='/static/demo/metinfos.css'>
    </head>
    <!-- END HEAD -->
    <body class="  class-10001">
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

        <?php //$this->beginBody() ?>
            <!--   侧边栏控制按钮  -->
            <div class="side-open">
                <hr>
                <hr>
                <hr>
                <hr>
            </div>
            <!--  侧边栏  -->
            <?php $this->beginContent('@app/views/layouts/hjz/side-box.php') ?><?php $this->endContent() ?>
            <!-- 正文 -->
            <?=$content?>
            <div class="modal fade modal-3d-flip-vertical" id="met-ewm-modal" aria-hidden="true" role="dialog" tabindex="-1">
                <div class="modal-ewmlog modal-center">
                    <div class="modal-content">
                        <div class="modal-body">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <img data-size="380_380" data-original="http://hjzhome.image.alimmdn.com/hjzWebsite/201501/1422258610.jpg" alt="APP应用开发|网站建设|平面设计-APP应用开发|网站建设|平面设计">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade modal-3d-flip-vertical" id="met-share-modal" aria-hidden="true" role="dialog" tabindex="-1">
                <div class="modal-sharelog modal-center">
                    <div class="modal-content">
                        <div class="modal-body">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <div class="bdsharebuttonbox info_share">
                                <a class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a>
                                <a class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a>
                                <a class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博"></a>
                                <a class="bds_renren" data-cmd="renren" title="分享到人人网"></a>
                                <a class="bds_weixin" data-cmd="weixin" title="分享到微信"></a>
                                <a class="bds_isohu" data-cmd="isohu" title="分享到我的搜狐"></a>
                                <a class="bds_sqq" data-cmd="sqq" title="分享到QQ好友"></a>
                                <a class="bds_tqf" data-cmd="tqf" title="分享到腾讯朋友"></a>
                                <a class="bds_huaban" data-cmd="huaban" title="分享到花瓣"></a>
                                <a class="bds_fbook" data-cmd="fbook" title="分享到Facebook"></a>
                                <a class="bds_linkedin" data-cmd="linkedin" title="分享到linkedin"></a>
                                <a class="bds_twi" data-cmd="twi" title="分享到Twitter"></a>
                                <a class="bds_douban" data-cmd="douban" title="分享到豆瓣网"></a>
                                <a class="bds_kaixin001" data-cmd="kaixin001" title="分享到开心网"></a>
                                <a class="bds_bdysc" data-cmd="bdysc" title="分享到百度云收藏"></a>
                                <a class="bds_bdxc" data-cmd="bdxc" title="分享到百度相册"></a>
                                <a class="bds_tieba" data-cmd="tieba" title="分享到百度贴吧"></a>
                                <a class="bds_bdhome" data-cmd="bdhome" title="分享到百度新首页"></a>
                                <a class="bds_thx" data-cmd="thx" title="分享到和讯微博"></a>
                                <a class="bds_ibaidu" data-cmd="ibaidu" title="分享到百度中心"></a>
                                <a class="bds_meilishuo" data-cmd="meilishuo" title="分享到美丽说"></a>
                                <a class="bds_mogujie" data-cmd="mogujie" title="分享到蘑菇街"></a>
                                <a class="bds_duitang" data-cmd="duitang" title="分享到堆糖"></a>
                                <a class="bds_diandian" data-cmd="diandian" title="分享到点点网"></a>
                                <a class="bds_hx" data-cmd="hx" title="分享到和讯"></a>
                                <a class="bds_fx" data-cmd="fx" title="分享到飞信"></a>
                                <a class="bds_youdao" data-cmd="youdao" title="分享到有道云笔记"></a>
                                <a class="bds_qingbiji" data-cmd="qingbiji" title="分享到轻笔记"></a>
                                <a class="bds_sdo" data-cmd="sdo" title="分享到麦库记事"></a>
                                <a class="bds_xinhua" data-cmd="xinhua" title="分享到新华微博"></a>
                                <a class="bds_people" data-cmd="people" title="分享到人民微博"></a>
                                <a class="bds_mail" data-cmd="mail" title="分享到邮件分享"></a>
                                <a class="bds_yaolan" data-cmd="yaolan" title="分享到摇篮空间"></a>
                                <a class="bds_ty" data-cmd="ty" title="分享到天涯社区"></a>
                                <a class="bds_wealink" data-cmd="wealink" title="分享到若邻网"></a>
                                <a class="bds_h163" data-cmd="h163" title="分享到网易热"></a>
                                <a class="bds_iguba" data-cmd="iguba" title="分享到股吧"></a>
                                <a class="bds_evernotecn" data-cmd="evernotecn" title="分享到印象笔记"></a>
                                <a class="bds_print" data-cmd="print" title="分享到打印"></a>
                                <a class="bds_mshare" data-cmd="mshare" title="分享到一键分享"></a>
                                <a class="bds_copy" data-cmd="copy" title="分享到复制网址"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php //$this->endBody() ?>
        <script src="/static/demo/metinfos.js"></script>
    </body>
</html>
<?php //$this->endPage() ?>