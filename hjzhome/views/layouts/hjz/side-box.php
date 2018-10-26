<?php
use yii\helpers\Url;
?>
<div class="load-box">
    <svg viewBox="0 0 120 120" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
        <g>
            <circle cx="35" cy="16.6987298" r="13"></circle>
            <circle cx="16.6987298" cy="35" r="13"></circle>
            <circle cx="10" cy="60" r="13"></circle>
            <circle cx="16.6987298" cy="85" r="13"></circle>
            <circle cx="35" cy="103.30127" r="13"></circle>
            <circle cx="60" cy="110" r="13"></circle>
            <circle cx="85" cy="103.30127" r="13"></circle>
            <circle cx="103.30127" cy="85" r="13"></circle>
            <circle cx="110" cy="60" r="13"></circle>
            <circle cx="103.30127" cy="35" r="13"></circle>
            <circle cx="85" cy="16.6987298" r="13"></circle>
            <circle cx="60" cy="10" r="13"></circle>
        </g>
    </svg>
</div>
<div class="side-box">
    <div class="side-cut">
        <div class="side-shadow"></div>
        <div class="side-bin">
            <div class="side-search">
                <form method="get" action="https://show.metinfo.cn/muban/M1156010/328/search/">
                    <input type='hidden' name='lang' value='cn' />
                    <input type='hidden' name='class1' value='10001' />
                    <div class="form-group">
                        <div class="input-search">
                            <button type="submit" class="input-search-btn">
                                <i class="icon wb-search" aria-hidden="true"></i>
                            </button>
                            <input class="form-control none-border" name="searchword" value="" placeholder="Search title ...">
                        </div>
                    </div>
                </form>
            </div>
            <div class="side-nav">
                <ul>
                    <li class="nav-first active">
                        <a href="<?= Url::toRoute('index')?>" title="精彩首页">
                            <i class="fa fa-home"></i>
                            <b>精彩首页</b>
                        </a>
                    </li>

                    <li class="nav-first  ">
                        <a href="<?= Url::toRoute(['page','id'=>16])?>"  title="服务项目" data-alert="全部" >
                            <i class="fa fa-home fa-coffee"></i>
                            <b>免费设计</b>
                        </a>
                    </li>
                    <li class="nav-first  ">
                        <a href="<?= Url::toRoute('about')?>"  title="关于我们" data-alert="全部" >
                            <i class="fa fa-home fa-pie-chart"></i>
                            <b>关于我们</b>
                        </a>
                    </li>
                    <li class="nav-first has ">
                        <a href="<?= Url::toRoute('picture')?>"  title="产品中心" data-alert="全部">
                            <i class="fa fa-home fa-camera"></i>
                            <b>产品中心</b>
                            <p>11</p>
                        </a>
                        <u>&nbsp;</u>
                        <i>&nbsp;</i>
                        <ul>
                            <dl>
                                <dt>
                                    <img width="400" data-original="http://hjzimage.image.alimmdn.com/hjz/3/%E9%BB%91%E7%99%BD%E7%81%B0%E5%A4%B4%E5%9B%BE.png@1e_1c_400w_216h">
                                </dt>
                                <dd>荟家装-健康智慧整装，隆重推出多款负离子健康套餐，囊括北欧简约，新中式，欧式轻奢，地中海风格，美式田园，宜家简约等多种装修风格。</dd>
                            </dl>
                            <li class="nav-second">
                                <a href="<?= Url::toRoute(['goods','goods_id'=>3434])?>"  title="东方元素" data-alert="全部" target="_blank">
                                    <b>东方元素</b>
                                </a>
                            </li>
                            <li class="nav-second">
                                <a href="<?= Url::toRoute(['goods','goods_id'=>3435])?>"  title="纳维亚北欧" data-alert="全部" target="_blank">
                                    <b>纳维亚北欧</b>
                                </a>
                            </li>
                            <li class="nav-second">
                                <a href="<?= Url::toRoute(['goods','goods_id'=>3433])?>"  title="都市印象" data-alert="全部" target="_blank">
                                    <b>都市印象</b>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-first  ">
                        <a href="<?= Url::toRoute('case')?>"  title="案例展示" data-alert="全部" >
                            <i class="fa fa-home fa-flag"></i>
                            <b>案例展示</b>
                            <p>64</p>
                        </a>
                    </li>
                    <li class="nav-first has ">
                        <a href="<?= Url::toRoute('news')?>"  title="新闻资讯" data-alert="全部" >
                            <i class="fa fa-home fa-bell"></i>
                            <b>新闻资讯</b>
                            <p>8</p>
                        </a>
                        <u>&nbsp;</u>
                        <i>&nbsp;</i>
                        <ul>
                            <dl>
                                <dt>
                                    <img width="400" data-original="http://hjzimage.image.alimmdn.com/hjz/3/%E9%BB%91%E7%99%BD%E7%81%B0%E5%A4%B4%E5%9B%BE.png@1e_1c_400w_216h">
                                </dt>
                                <dd>荟家装-装修学问课堂,为你推介入门装修攻略,新家宝典</dd>
                            </dl>
                            <li class="nav-second">
                                <a href="<?= Url::toRoute(['news','type'=>89])?>"  title="新家宝典" data-alert="全部">
                                    <b>新家宝典</b>
                                </a>
                            </li>
                            <li class="nav-second">
                                <a href="<?= Url::toRoute(['news','type'=>88])?>"  title="家装攻略" data-alert="全部">
                                    <b>家装攻略</b>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-first  ">
                        <a href="<?= Url::toRoute('about')?>"  title="联系我们" data-alert="全部" >
                            <i class="fa fa-home fa-book"></i>
                            <b>联系我们</b>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="side-foot">
                <div class="side-phone">
                    <p>
                        <b>Call me :</b>
                        <a href="tel:400-000-0000">400-6966-398</a>
                    </p>
                    <i class="fa fa-qrcode" data-toggle="modal" data-target="#met-ewm-modal"></i>
                </div>
                <div class="social-box">
                    <audio id="audio" src="/static/demo/bg.mp3" status="1"></audio>
                    <canvas id="canvas" width="105" height="34"></canvas>
                    <a rel="nofollow" data-toggle="modal" data-target="#met-share-modal">
                        <i class="fa fa-share-alt"></i>
                    </a>
                    <a href="javascript:;" rel="nofollow" target="_blank">
                        <i class="fa fa-qq"></i>
                    </a>
                    <a href="http://www.weibo.com" rel="nofollow" target="_blank">
                        <i class="fa fa-weibo"></i>
                    </a>
                </div>
                <div class="side-text">Copyright © 2018 荟家装健康智慧整装</div>
            </div>
        </div>
    </div>
</div>

<!-- 模态弹窗 -->
<div class="modal fade modal-3d-flip-vertical" id="met-ewm-modal" aria-hidden="true" role="dialog" tabindex="-1">
    <div class="modal-ewmlog modal-center">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <img data-size="380_380" data-original="http://hjzhome.image.alimmdn.com/hjzWebsite/首页图/官网二维码.png" alt="荟家装健康智慧整装">
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