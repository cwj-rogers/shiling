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
    <meta name="generator" content="MetInfo 5.3.19"  data-variable="https://show.metinfo.cn/muban/M1156010/328/,cn,25,,7,M1156010" />
</head>
<body class="class-25">
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
                <a href="<?= Url::toRoute(['about'])?>"  title="全部">
                    <b>全部</b>
                </a>
            </li>
            <li class="sign-li active">
                <a href="<?= Url::toRoute(['message'])?>"  title="查看留言">
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
                    <div class="row" id="show-msg">
                        <div>
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active"><a href="#contract" aria-controls="contract" role="tab" data-toggle="tab">联系方式留言</a></li>
                                <li role="presentation"><a href="#free" aria-controls="free" role="tab" data-toggle="tab">免费设计留言</a></li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="contract">
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
                                <div role="tabpanel" class="tab-pane" id="free">
                                    <div class="met-editor lazyload clearfix">
                                        <div class="form-group ftype_textarea">
                                            <div>
                                                <?php if ($checkout):?>
                                                    <textarea name='para118' class='form-control' placeholder='内容 ' rows='20'><?= $info2?></textarea>
                                                <?php endif;?>
                                            </div>
                                        </div>
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