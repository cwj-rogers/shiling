<?php
use yii\helpers\Url;
?>
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
                        <a href="<?= Url::toRoute('about')?>"  title="关于我们" data-alert="全部" >
                            <i class="fa fa-home fa-pie-chart"></i>
                            <b>关于我们</b>
                        </a>
                    </li>
                    <li class="nav-first  ">
                        <a href="<?= Url::toRoute('server')?>"  title="服务项目" data-alert="全部" >
                            <i class="fa fa-home fa-coffee"></i>
                            <b>服务项目</b>
                        </a>
                    </li>
                    <li class="nav-first has ">
                        <a href="<?= Url::toRoute('picture')?>"  title="产品中心" data-alert="全部" >
                            <i class="fa fa-home fa-camera"></i>
                            <b>产品中心</b>
                            <p>16</p>
                        </a>
                        <u>&nbsp;</u>
                        <i>&nbsp;</i>
                        <ul>
                            <dl>
                                <dt>
                                    <img width="400" data-original="http://hjzhome.image.alimmdn.com/hjzWebsite/201707/1500551146.jpg">
                                </dt>
                                <dd>APP技术原本是对软件进行加速运算或进行大型科学运算的技术，基于Paas开发平台开发出的APP，直接部署在云环境上，形成一种租用云服务的模式。</dd>
                            </dl>
                            <li class="nav-second">
                                <a href="picture/product.php?lang=cn&class2=111"  title="APP开发" data-alert="全部">
                                    <b>APP开发</b>
                                </a>
                            </li>
                            <li class="nav-second">
                                <a href="picture/product.php?lang=cn&class2=112"  title="网站建设" data-alert="全部">
                                    <b>网站建设</b>
                                </a>
                            </li>
                            <li class="nav-second">
                                <a href="picture/product.php?lang=cn&class2=113"  title="平面设计" data-alert="全部">
                                    <b>平面设计</b>
                                </a>
                            </li>
                        </ul>
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
                                    <img width="400" data-original="http://hjzhome.image.alimmdn.com/hjzWebsite/201707/1500550854.jpg">
                                </dt>
                                <dd>网站打开慢的其中一个原因是图片文件过大，一个网站在打开时需要同时加载很多图片，如果网站中每张图片都很大就容易发生卡顿状态！</dd>
                            </dl>
                            <li class="nav-second">
                                <a href="news/news.php?lang=cn&class2=115"  title="公司新闻" data-alert="全部">
                                    <b>公司新闻</b>
                                </a>
                            </li>
                            <li class="nav-second">
                                <a href="news/news.php?lang=cn&class2=116"  title="行业资讯" data-alert="全部">
                                    <b>行业资讯</b>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-first  ">
                        <a href="<?= Url::toRoute('case')?>"  title="案例展示" data-alert="全部" >
                            <i class="fa fa-home fa-flag"></i>
                            <b>案例展示</b>
                            <p>24</p>
                        </a>
                    </li>
                    <li class="nav-first  ">
                        <a href="<?= Url::toRoute('message')?>"  title="联系我们" data-alert="全部" >
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
                        <a href="tel:400-000-0000">400-000-0000</a>
                    </p>
                    <i class="fa fa-qrcode" data-toggle="modal" data-target="#met-ewm-modal"></i>
                </div>
                <div class="social-box">
                    <audio id="audio" src="/static/demo/bg.mp3" status="1"></audio>
                    <canvas id="canvas" width="105" height="34"></canvas>
                    <a rel="nofollow" data-toggle="modal" data-target="#met-share-modal">
                        <i class="fa fa-share-alt"></i>
                    </a>
                    <a href="http://crm2.qq.com/page/portalpage/wpa.php?uin=40000844433&aty=0&a=0&curl=&ty=1" rel="nofollow" target="_blank">
                        <i class="fa fa-qq"></i>
                    </a>
                    <a href="http://www.weibo.com" rel="nofollow" target="_blank">
                        <i class="fa fa-weibo"></i>
                    </a>
                </div>
                <div class="side-text">Copyright © 2017 电影快讯</div>
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
                <img data-size="380_380" data-original="http://hjzhome.image.alimmdn.com/hjzWebsite/201501/1422258610.jpg" alt="服务项目-APP应用开发|网站建设|平面设计">
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